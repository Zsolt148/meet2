<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * App\Models\Location
 *
 * @property int $id
 * @property string $city
 * @property string $address
 * @property int $pool
 * @property string $timing
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Meet[] $meets
 * @property-read int|null $meets_count
 * @method static \Illuminate\Database\Eloquent\Builder|Location newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Location query()
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location wherePool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereTiming($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Location whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Location extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'city',
        'address',
        'pool',
        'timing'
    ];

    protected static $logOnlyDirty = true;
    protected static $logAttributes = ['*'];

    protected $casts = [
        'pool' => 'integer'
    ];

    public function meets()
    {
        return $this->hasMany(Meet::class, 'location_id');
    }
}
