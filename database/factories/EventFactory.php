<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'location' => fake()->city(),
            'event_date' => now()->addDays(fake()->numberBetween(2, 60)),
            'capacity' => fake()->numberBetween(50, 500),
            'status' => 'active',
        ];
    }
}
