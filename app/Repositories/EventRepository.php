<?php

namespace App\Repositories;

use App\Enums\EventStatus;
use App\Models\Event;
use App\Repositories\Contracts\EventRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class EventRepository implements EventRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Event::query()->latest('event_date')->paginate($perPage);
    }

    public function activeUpcoming(int $limit = 6): Collection
    {
        return Event::query()
            ->where('status', EventStatus::Active->value)
            ->where('event_date', '>=', now())
            ->orderBy('event_date')
            ->limit($limit)
            ->get();
    }

    public function allActive(): Collection
    {
        return Event::query()
            ->where('status', EventStatus::Active->value)
            ->orderBy('event_date')
            ->get();
    }

    public function find(string $id): ?Event
    {
        return Event::query()->find($id);
    }

    public function create(array $data): Event
    {
        return Event::query()->create($data);
    }

    public function update(Event $event, array $data): Event
    {
        $event->update($data);

        return $event->refresh();
    }

    public function delete(Event $event): void
    {
        $event->delete();
    }

    public function count(): int
    {
        return Event::query()->count();
    }
}
