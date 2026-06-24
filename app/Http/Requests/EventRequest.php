<?php

namespace App\Http\Requests;

use App\Enums\EventStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdmin() === true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:160'],
            'description' => ['required', 'string', 'max:5000'],
            'location' => ['required', 'string', 'max:200'],
            'event_date' => ['required', 'date'],
            'capacity' => ['required', 'integer', 'min:1', 'max:100000'],
            'status' => ['required', Rule::enum(EventStatus::class)],
        ];
    }
}
