<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitorEvent extends Model
{
    protected $fillable = [
        'session_id',
        'ip_address',
        'country_code',
        'country_name',
        'url',
        'referrer',
        'source',
        'user_agent',
        'visited_at',
    ];

    protected function casts(): array
    {
        return [
            'visited_at' => 'datetime',
        ];
    }
}

