<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckInRequest extends FormRequest
{
    protected function prepareForValidation(): void
    {
        if (is_string($this->payload)) {
            $decoded = json_decode($this->payload, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                $this->merge(['payload' => $decoded]);
            }
        }
    }

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ticket_code' => ['required_without:payload', 'string', 'max:40'],
            'payload' => ['nullable', 'array'],
            'payload.ticket_code' => ['required_with:payload', 'string', 'max:40'],
        ];
    }

    public function ticketCode(): string
    {
        return $this->input('ticket_code', $this->input('payload.ticket_code'));
    }
}
