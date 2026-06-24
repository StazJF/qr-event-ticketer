<?php

namespace Tests\Unit;

use App\Models\Attendee;
use App\Services\QrCodeService;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class QrCodeServiceTest extends TestCase
{
    public function test_it_writes_qr_code_to_public_storage(): void
    {
        Storage::fake('public');

        $attendee = new Attendee([
            'event_id' => 'event-id',
            'ticket_code' => 'EVT-2026-000123',
        ]);
        $attendee->_id = 'attendee-id';

        $path = (new QrCodeService())->generateForAttendee($attendee);

        $this->assertSame('qrcodes/EVT-2026-000123.png', $path);
        Storage::disk('public')->assertExists($path);
    }
}
