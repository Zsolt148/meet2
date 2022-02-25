<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property string $length
 * @property string $sex
 * @property string $swim
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereLength($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereSwim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Meet[] $meets
 * @property-read int|null $meets_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 */
class Event extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'length',
        'sex',
        'swim'
    ];

    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['length', 'sex', 'swim'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function meets()
    {
        return $this->belongsToMany(Meet::class, 'meet_event', 'event_id', 'meet_id')
            ->using(MeetEvent::class)
            ->withTimestamps()
            ->withPivot('order', 'category');
    }
}
