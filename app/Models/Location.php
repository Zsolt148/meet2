<?php

namespace App\Models;

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
}
