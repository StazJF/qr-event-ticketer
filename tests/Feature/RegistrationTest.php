<?php

namespace Tests\Feature;

use App\Models\Attendee;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->clearMongoCollections();
        Storage::fake('public');
    }

    public function test_public_user_can_register_and_receive_qr_ticket(): void
    {
        $event = Event::factory()->create(['capacity' => 2]);

        $response = $this->post(route('events.register', $event), [
            'full_name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
            'phone' => '+6590000000',
        ]);

        $ticket = Attendee::query()->where('email', 'ada@example.com')->first();

        $response->assertRedirect(route('tickets.show', $ticket->ticket_code));
        $this->assertNotNull($ticket);
        $this->assertMatchesRegularExpression('/^EVT-\d{4}-\d{6}$/', $ticket->ticket_code);
        Storage::disk('public')->assertExists($ticket->qr_code_path);
    }

    public function test_duplicate_email_for_same_event_is_rejected(): void
    {
        $event = Event::factory()->create(['capacity' => 2]);
        Attendee::factory()->create(['event_id' => (string) $event->getKey(), 'email' => 'ada@example.com']);

        $response = $this->from(route('events.public.show', $event))->post(route('events.register', $event), [
            'full_name' => 'Ada Lovelace',
            'email' => 'ada@example.com',
        ]);

        $response->assertRedirect(route('events.public.show', $event));
        $response->assertSessionHasErrors('email');
    }

    public function test_capacity_limit_is_enforced(): void
    {
        $event = Event::factory()->create(['capacity' => 1]);
        Attendee::factory()->create(['event_id' => (string) $event->getKey()]);

        $response = $this->from(route('events.public.show', $event))->post(route('events.register', $event), [
            'full_name' => 'Grace Hopper',
            'email' => 'grace@example.com',
        ]);

        $response->assertSessionHasErrors('email');
    }
}
