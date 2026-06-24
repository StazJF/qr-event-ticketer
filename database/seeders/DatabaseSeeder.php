<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->createIndexes();

        User::query()->updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@example.com')],
            [
                'name' => env('ADMIN_NAME', 'System Admin'),
                'password' => env('ADMIN_PASSWORD', 'password'),
                'role' => 'admin',
            ]
        );

        Event::query()->firstOrCreate(
            ['title' => 'Laravel QR Summit 2026'],
            [
                'description' => 'A focused event for event organizers, builders, and Laravel teams.',
                'location' => 'Singapore Expo',
                'event_date' => now()->addMonth(),
                'capacity' => 250,
                'status' => 'active',
            ]
        );
    }

    private function createIndexes(): void
    {
        $database = DB::connection('mongodb')->getDatabase();

        $database->users->createIndex(['email' => 1], ['unique' => true]);
        $database->attendees->createIndex(['event_id' => 1, 'email' => 1], ['unique' => true]);
        $database->attendees->createIndex(['ticket_code' => 1], ['unique' => true]);
        $database->events->createIndex(['status' => 1, 'event_date' => 1]);
    }
}
