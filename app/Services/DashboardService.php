<?php

namespace App\Services;

use App\Repositories\Contracts\AttendeeRepositoryInterface;
use App\Repositories\Contracts\EventRepositoryInterface;

class DashboardService
{
    public function __construct(
        private readonly EventRepositoryInterface $events,
        private readonly AttendeeRepositoryInterface $attendees,
    ) {
    }

    public function summary(): array
    {
        return [
            'total_events' => $this->events->count(),
            'total_attendees' => $this->attendees->count(),
            'total_check_ins' => $this->attendees->checkedInCount(),
            'upcoming_events' => $this->events->activeUpcoming(),
        ];
    }
}
