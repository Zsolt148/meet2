<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\MeetNews
 *
 * @property int $id
 * @property int $meet_id
 * @property string|null $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MeetNews newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MeetNews newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MeetNews query()
 * @method static \Illuminate\Database\Eloquent\Builder|MeetNews whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeetNews whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeetNews whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeetNews whereMeetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MeetNews whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 */
class MeetNews extends Model
{
    use LogsActivity;

    protected $fillable = [
        'meet_id',
        'body',
    ];

    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['*'];

}
