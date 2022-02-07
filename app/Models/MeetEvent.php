<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Relations\Pivot;

class MeetEvent extends Pivot
{
    public $incrementing = true;

    public $timestamps = true;

    protected $fillable = [
        'meet_id',
        'event_id',
        'order',
        'category',
    ];

    protected $casts = [
        'order' => 'integer',
    ];
}