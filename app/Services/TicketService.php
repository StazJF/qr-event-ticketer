<?php

namespace App\Services;

use App\Models\Attendee;
use App\Repositories\Contracts\AttendeeRepositoryInterface;

class TicketService
{
    public function __construct(private readonly AttendeeRepositoryInterface $attendees)
    {
    }

    public function findByCode(string $code): ?Attendee
    {
        return $this->attendees->findByTicketCode($code)?->load('event');
    }
}
