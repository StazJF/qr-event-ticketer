<?php

namespace Tests\Feature;

use App\Models\Attendee;
use App\Models\User;
use Tests\TestCase;

class CheckInTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->clearMongoCollections();
    }

    public function test_admin_can_check_in_valid_ticket(): void
    {
        $admin = User::factory()->create();
        $ticket = Attendee::factory()->create(['ticket_code' => 'EVT-2026-000001']);

        $response = $this->actingAs($admin)->post(route('admin.checkin.store'), [
            'ticket_code' => 'EVT-2026-000001',
        ]);

        $response->assertSessionHas('status');
        $this->assertTrue($ticket->refresh()->checked_in);
        $this->assertNotNull($ticket->checked_in_at);
    }

    public function test_already_checked_in_ticket_is_rejected(): void
    {
        $admin = User::factory()->create();
        Attendee::factory()->create(['ticket_code' => 'EVT-2026-000002', 'checked_in' => true]);

        $response = $this->actingAs($admin)->post(route('admin.checkin.store'), [
            'ticket_code' => 'EVT-2026-000002',
        ]);

        $response->assertSessionHasErrors('ticket_code');
    }

    public function test_invalid_ticket_is_rejected(): void
    {
        $admin = User::factory()->create();

        $response = $this->actingAs($admin)->post(route('admin.checkin.store'), [
            'ticket_code' => 'EVT-2026-404404',
        ]);

        $response->assertSessionHasErrors('ticket_code');
    }
}
