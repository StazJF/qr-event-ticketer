<?php

namespace App\Services;

use App\Repositories\Contracts\AttendeeRepositoryInterface;

class TicketCodeGenerator
{
    public function __construct(private readonly AttendeeRepositoryInterface $attendees)
    {
    }

    public function next(): string
    {
        $year = (int) now()->format('Y');
        $sequence = $this->attendees->latestSequenceForYear($year) + 1;

        return sprintf('EVT-%d-%06d', $year, $sequence);
    }
}
