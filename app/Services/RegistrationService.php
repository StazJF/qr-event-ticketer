<?php

namespace App\Services;

use App\Models\Attendee;
use App\Models\Event;
use App\Repositories\Contracts\AttendeeRepositoryInterface;
use DomainException;

class RegistrationService
{
    public function __construct(
        private readonly AttendeeRepositoryInterface $attendees,
        private readonly TicketCodeGenerator $ticketCodes,
        private readonly QrCodeService $qrCodes,
    ) {
    }

    public function register(Event $event, array $data): Attendee
    {
        if ($this->attendees->findByEventAndEmail($event, $data['email'])) {
            throw new DomainException('This email is already registered for the event.');
        }

        if ($this->attendees->countForEvent($event) >= $event->capacity) {
            throw new DomainException('This event is already at full capacity.');
        }

        $attendee = $this->attendees->create([
            'event_id' => (string) $event->getKey(),
            'full_name' => $data['full_name'],
            'email' => strtolower($data['email']),
            'phone' => $data['phone'] ?? null,
            'ticket_code' => $this->ticketCodes->next(),
            'checked_in' => false,
            'checked_in_at' => null,
        ]);

        $attendee->update(['qr_code_path' => $this->qrCodes->generateForAttendee($attendee)]);

        return $attendee->refresh();
    }
}
