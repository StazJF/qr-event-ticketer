<?php

namespace Database\Factories;

use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendeeFactory extends Factory
{
    protected $model = Attendee::class;

    public function definition(): array
    {
        return [
            'event_id' => (string) Event::factory()->create()->getKey(),
            'full_name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'ticket_code' => sprintf('EVT-%s-%06d', now()->format('Y'), fake()->unique()->numberBetween(1, 999999)),
            'qr_code_path' => 'qrcodes/sample.png',
            'checked_in' => false,
            'checked_in_at' => null,
        ];
    }
}
