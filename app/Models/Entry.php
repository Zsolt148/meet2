<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Entry
 *
 * @property int $id
 * @property int $user_id
 * @property int $competitor_id
 * @property int $meet_id
 * @property int $meet_event_id
 * @property string $time
 * @property bool $is_final
 * @property bool $is_paid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Competitor $competitor
 * @property-read \App\Models\Meet $meet
 * @property-read \App\Models\MeetEvent $meetEvent
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Entry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Entry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Entry query()
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereCompetitorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereIsFinal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereIsPaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereMeetEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereMeetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Entry whereUserId($value)
 * @mixin \Eloquent
 */
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

    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['*'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id')
            ->with('team');
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
        return $this->belongsTo(MeetEvent::class, 'meet_event_id')
            ->with('event');
    }

    public function isFinal()
    {
        return $this->is_final;
    }

    public function isPaid()
    {
        return $this->is_paid;
    }
}
