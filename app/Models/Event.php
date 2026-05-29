<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'event_date',
        'event_time',
        'reminder_at',
    ];

    protected function casts(): array
    {
        return [
            'event_date' => 'date',
            'reminder_at' => 'datetime',
        ];
    }
}
