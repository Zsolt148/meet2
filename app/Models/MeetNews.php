<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
 */
class MeetNews extends Model
{
    protected $fillable = [
        'meet_id',
        'body',
    ];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y.m.d H:i');
    }
}
