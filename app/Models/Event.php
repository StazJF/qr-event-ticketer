<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $collection = 'events';

    protected $fillable = [
        'title',
        'description',
        'location',
        'event_date',
        'capacity',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'datetime',
            'capacity' => 'integer',
        ];
    }

    public function attendees()
    {
        return $this->hasMany(Attendee::class, 'event_id');
    }
}
