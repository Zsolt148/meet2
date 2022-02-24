<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Competitor
 *
 * @property int $id
 * @property string|null $foreign_id
 * @property int|null $team_id
 * @property string $name
 * @property string|null $sex
 * @property string $birth
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Entry[] $entries
 * @property-read int|null $entries_count
 * @property-read \App\Models\Team|null $team
 * @method static \Illuminate\Database\Eloquent\Builder|Competitor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Competitor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Competitor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Competitor senior()
 * @method static \Illuminate\Database\Eloquent\Builder|Competitor whereBirth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competitor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competitor whereForeignId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competitor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competitor whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competitor whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competitor whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competitor whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Competitor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Competitor extends Model
{
    protected $fillable = [
        'foreign_id',
        'team_id',
        'name',
        'birth',
        'sex',
        'type',
    ];

    const TYPE_SENIOR = 'senior';

    CONST TYPES = [
        self::TYPE_SENIOR,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entries()
    {
        return $this->hasMany(Entry::class, 'competitor_id');
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeSenior($query)
    {
        return $query->whereType(self::TYPE_SENIOR);
    }

    /**
     * @param $date
     * @return string
     */
    protected function setCreatedAtAttribute($date)
    {
        $this->attributes['created_at'] = $date;
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
