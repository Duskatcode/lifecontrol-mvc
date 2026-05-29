<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'name',
        'service',
        'reservation_date',
        'reservation_time',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'reservation_date' => 'date',
        ];
    }
}
