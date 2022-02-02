<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'SA',
        'address',
    ];

    const TYPE_SENIOR = 'senior';

    CONST TYPES = [
        self::TYPE_SENIOR,
    ];

    protected function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y.m.d H:i');
    }
}
