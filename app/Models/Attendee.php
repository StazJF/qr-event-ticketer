<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Attendee extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $collection = 'attendees';

    protected $fillable = [
        'event_id',
        'full_name',
        'email',
        'phone',
        'ticket_code',
        'qr_code_path',
        'checked_in',
        'checked_in_at',
    ];

    protected function casts(): array
    {
        return [
            'checked_in' => 'boolean',
            'checked_in_at' => 'datetime',
        ];
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
