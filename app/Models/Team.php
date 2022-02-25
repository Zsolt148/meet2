<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Team
 *
 * @property int $id
 * @property string $name
 * @property string|null $type
 * @property string|null $SA
 * @property string|null $address
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Team newQuery()
 * @method static \Illuminate\Database\Query\Builder|Team onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereSA($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Team withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Team withoutTrashed()
 * @mixin \Eloquent
 * @property string|null $country
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Competitor[] $competitors
 * @property-read int|null $competitors_count
 * @method static \Illuminate\Database\Eloquent\Builder|Team senior()
 * @method static \Illuminate\Database\Eloquent\Builder|Team whereCountry($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Activitylog\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @method static \Illuminate\Database\Eloquent\Builder|Team other()
 */
class Team extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $fillable = [
        'name',
        'type',
        'country',
        'SA',
        'address',
    ];

    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['*'];

    const TYPE_SENIOR = 'senior';
    const TYPE_OTHER = 'other';

    CONST TYPES = [
        self::TYPE_SENIOR,
        self::TYPE_OTHER,
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function competitors()
    {
        return $this->hasMany(Competitor::class, 'team_id');
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
     * @param $query
     * @return mixed
     */
    public function scopeOther($query)
    {
        return $query->orWhere('type', self::TYPE_OTHER);
    }
}
