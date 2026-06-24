<?php

namespace App\Repositories;

use App\Models\Attendee;
use App\Models\Event;
use App\Repositories\Contracts\AttendeeRepositoryInterface;
use MongoDB\BSON\Regex;

class AttendeeRepository implements AttendeeRepositoryInterface
{
    public function create(array $data): Attendee
    {
        return Attendee::query()->create($data);
    }

    public function findByTicketCode(string $ticketCode): ?Attendee
    {
        return Attendee::query()
            ->where('ticket_code', strtoupper($ticketCode))
            ->first();
    }

    public function findByEventAndEmail(Event $event, string $email): ?Attendee
    {
        return Attendee::query()
            ->where('event_id', (string) $event->getKey())
            ->where('email', strtolower($email))
            ->first();
    }

    public function countForEvent(Event $event): int
    {
        return Attendee::query()
            ->where('event_id', (string) $event->getKey())
            ->count();
    }

    public function count(): int
    {
        return Attendee::query()->count();
    }

    public function checkedInCount(): int
    {
        return Attendee::query()->where('checked_in', true)->count();
    }

    public function markCheckedIn(Attendee $attendee): Attendee
    {
        $attendee->update([
            'checked_in' => true,
            'checked_in_at' => now(),
        ]);

        return $attendee->refresh();
    }

    public function latestSequenceForYear(int $year): int
    {
        $prefix = "EVT-{$year}-";
        $latest = Attendee::query()
            ->where('ticket_code', 'regex', new Regex('^'.preg_quote($prefix, '/')))
            ->orderByDesc('ticket_code')
            ->first();

        if (! $latest) {
            return 0;
        }

        return (int) substr($latest->ticket_code, -6);
    }
}
