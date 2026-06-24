<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class TicketResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->getKey(),
            'event_id' => $this->event_id,
            'event' => $this->whenLoaded('event', fn () => new EventResource($this->event)),
            'full_name' => $this->full_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'ticket_code' => $this->ticket_code,
            'qr_code_url' => $this->qr_code_path ? Storage::disk('public')->url($this->qr_code_path) : null,
            'checked_in' => $this->checked_in,
            'checked_in_at' => $this->checked_in_at?->toIso8601String(),
        ];
    }
}
