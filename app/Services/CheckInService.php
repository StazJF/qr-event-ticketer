<?php

namespace App\Services;

use App\Models\Attendee;
use App\Repositories\Contracts\AttendeeRepositoryInterface;
use DomainException;

class CheckInService
{
    public function __construct(private readonly AttendeeRepositoryInterface $attendees)
    {
    }

    public function checkIn(string $ticketCode): Attendee
    {
        $attendee = $this->attendees->findByTicketCode($ticketCode);

        if (! $attendee) {
            throw new DomainException('Invalid ticket.');
        }

        if ($attendee->checked_in) {
            throw new DomainException('Ticket has already been checked in.');
        }

        return $this->attendees->markCheckedIn($attendee);
    }
}
