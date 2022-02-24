<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Models\MeetEvent
 *
 * @property int $id
 * @property int $meet_id
 * @property int $event_id
 * @property int|null $order
 * @property string|null $category
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MeetEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MeetEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MeetEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder|MeetEvent whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeetEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeetEvent whereEventId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeetEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeetEvent whereMeetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeetEvent whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeetEvent whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Entry[] $entries
 * @property-read int|null $entries_count
 * @property-read \App\Models\Event $event
 */
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entries()
    {
        return $this->hasMany(Entry::class, 'meet_event_id');
    }
}