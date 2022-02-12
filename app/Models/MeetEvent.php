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
}