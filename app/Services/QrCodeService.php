<?php

namespace App\Services;

use App\Models\Attendee;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\Storage;

class QrCodeService
{
    public function generateForAttendee(Attendee $attendee): string
    {
        $payload = json_encode([
            'ticket_code' => $attendee->ticket_code,
            'event_id' => $attendee->event_id,
            'attendee_id' => (string) $attendee->getKey(),
        ], JSON_THROW_ON_ERROR);

        $result = (new Builder(
            writer: new PngWriter(),
            data: $payload,
            size: 360,
            margin: 16,
        ))->build();

        $path = sprintf('qrcodes/%s.png', $attendee->ticket_code);

        Storage::disk('public')->put($path, $result->getString());

        return $path;
    }
}
