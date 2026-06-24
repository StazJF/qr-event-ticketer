<?php

namespace App\Repositories\Contracts;

use App\Models\Event;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface EventRepositoryInterface
{
    public function paginate(int $perPage = 10): LengthAwarePaginator;

    public function activeUpcoming(int $limit = 6): Collection;

    public function allActive(): Collection;

    public function find(string $id): ?Event;

    public function create(array $data): Event;

    public function update(Event $event, array $data): Event;

    public function delete(Event $event): void;

    public function count(): int;
}
