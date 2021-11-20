<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'address',
        'pool',
        'timing'
    ];

    protected $casts = [
        'pool' => 'integer'
    ];

    public function meets()
    {
        return $this->hasMany(Meet::class, 'location_id');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y.m.d H:i');
    }
}
