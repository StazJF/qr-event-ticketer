<?php

namespace App\Repositories\Contracts;

use App\Models\Attendee;
use App\Models\Event;

interface AttendeeRepositoryInterface
{
    public function create(array $data): Attendee;

    public function findByTicketCode(string $ticketCode): ?Attendee;

    public function findByEventAndEmail(Event $event, string $email): ?Attendee;

    public function countForEvent(Event $event): int;

    public function count(): int;

    public function checkedInCount(): int;

    public function markCheckedIn(Attendee $attendee): Attendee;

    public function latestSequenceForYear(int $year): int;
}
