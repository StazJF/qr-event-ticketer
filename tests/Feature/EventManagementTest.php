<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Tests\TestCase;

class EventManagementTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->clearMongoCollections();
    }

    public function test_admin_can_create_event(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->post(route('admin.events.store'), [
            'title' => 'Product Launch',
            'description' => 'Launch event',
            'location' => 'Main Hall',
            'event_date' => now()->addWeek()->format('Y-m-d H:i:s'),
            'capacity' => 100,
            'status' => 'active',
        ]);

        $response->assertRedirect();
        $this->assertSame(1, Event::query()->where('title', 'Product Launch')->count());
    }
}
