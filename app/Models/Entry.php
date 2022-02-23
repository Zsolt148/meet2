<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'competitor_id',
        'meet_id',
        'meet_event_id',
        'time',
        'is_final',
        'is_paid',
    ];

    protected $casts = [
        'is_final' => 'boolean',
        'is_paid' => 'boolean',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id')->with('team');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function competitor() 
    {
        return $this->belongsTo(Competitor::class, 'competitor_id');     
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function meet() 
    {
        return $this->belongsTo(Meet::class, 'meet_id');    
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function meetEvent()
    {
        return $this->belongsTo(MeetEvent::class, 'meet_event_id')->with('event');
    }

    public function isFinal()
    {
        return $this->is_final;
    }

    public function isPaid()
    {
        return $this->is_paid;
    }

    /**
     * @param $date
     * @return string
     */
    protected function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y.m.d H:i');
    }
}
