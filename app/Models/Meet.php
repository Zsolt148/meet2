<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'folder',
        'slug',
        'host',
        'type',
        'phases',
        'date',
        'deadline',
        'location_id',
        'contact_id',
        'is_visible',
    ];

    protected $casts = [
        'deadline' => 'datetime',
        'phases' => 'integer',
        'is_visible' => 'boolean',
    ];

    public function location()
    {
        return $this->belongsTo(Locations::class, 'location_id');
    }

    public function contact()
    {
        return $this->belongsTo(Contacts::class, 'contact_id');
    }

    public function allNews()
    {
        return $this->hasMany(News::class, 'meets_id')->orderBy('created_at', 'DESC');
    }

    public function meets_entry()
    {
        return $this->hasOne(meets_entry::class, 'meets_id');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y.m.d H:i');
    }
}
