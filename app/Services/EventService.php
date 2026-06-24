<?php

namespace App\Services;

use App\Enums\EventStatus;
use App\Models\Event;
use App\Repositories\Contracts\AttendeeRepositoryInterface;
use App\Repositories\Contracts\EventRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class EventService
{
    public function __construct(
        private readonly EventRepositoryInterface $events,
        private readonly AttendeeRepositoryInterface $attendees,
    ) {
    }

    public function paginated(int $perPage = 10): LengthAwarePaginator
    {
        return $this->events->paginate($perPage);
    }

    public function publicEvents(): Collection
    {
        return $this->events->allActive();
    }

    public function create(array $data): Event
    {
        return $this->events->create($this->normalize($data));
    }

    public function update(Event $event, array $data): Event
    {
        return $this->events->update($event, $this->normalize($data));
    }

    public function delete(Event $event): void
    {
        $this->events->delete($event);
    }

    public function attendeeCount(Event $event): int
    {
        return $this->attendees->countForEvent($event);
    }

    private function normalize(array $data): array
    {
        $data['status'] ??= EventStatus::Active->value;
        $data['capacity'] = (int) $data['capacity'];

        return $data;
    }
}
