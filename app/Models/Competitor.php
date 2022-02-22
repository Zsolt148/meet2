<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Competitor extends Model
{
    protected $fillable = [
        'foreign_id',
        'team_id',
        'name',
        'sex',
        'birth',
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
    protected function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y.m.d H:i');
    }
}
