<?php

namespace App\Models;

use App\Http\Resources\MediaResource;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\Meet
 *
 * @property int $id
 * @property string $name
 * @property string|null $slug
 * @property string|null $folder
 * @property string $host
 * @property string $type
 * @property int $phases
 * @property string $date
 * @property \Illuminate\Support\Carbon $deadline
 * @property int|null $location_id
 * @property int|null $contact_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property bool|null $is_visible
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Meet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Meet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereContactId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereFolder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereHost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meet wherePhases($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $race_info_id
 * @property string|null $pre_startlist_id
 * @property string|null $race_record_id
 * @property string|null $time_schedule_id
 * @property-read \App\Models\Contact|null $contact
 * @property-read \App\Models\Location|null $location
 * @method static \Illuminate\Database\Eloquent\Builder|Meet wherePreStartlistId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereRaceInfoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereRaceRecordId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereTimeScheduleId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MeetNews[] $news
 * @property-read int|null $news_count
 * @property-read \App\Models\Media|null $preStartlist
 * @property-read \App\Models\Media|null $raceInfo
 * @property-read \App\Models\Media|null $raceRecord
 * @property-read \App\Models\Media|null $timeSchedule
 * @method static \Illuminate\Database\Eloquent\Builder|Meet visible()
 * @property bool $is_entriable
 * @property string|null $entry_type
 * @property int $entry_price
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereEntryPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereEntryType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereIsEntriable($value)
 */
class Meet extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'is_visible',
        'is_entriable',
        'name',
        'entry_type',
        'entry_app',
        'entry_price',
        'folder',
        'slug',
        'host',
        'type',
        'phases',
        'date',
        'deadline',
        'location_id',
        'contact_id',
        'race_info_id',
        'pre_startlist_id',
        'race_record_id',
        'time_schedule_id'
    ];

    protected $casts = [
        'deadline' => 'date',
        'phases' => 'integer',
        'is_visible' => 'boolean',
        'is_entriable' => 'boolean',
        'entry_price' => 'integer',
    ];

    const ENTRY_TYPE_SENIOR = 'senior';

    const ENTRY_TYPES = [
        self::ENTRY_TYPE_SENIOR,
    ];

    const ENTRY_APP_MEET_MANAGER = 'meetmanager';
    const ENTRY_APP_SWIMMING = 'uszas';

    const ENTRY_APPS = [
        self::ENTRY_APP_MEET_MANAGER,
        //self::ENTRY_APP_SWIMMING,
    ];

    public function scopeVisible($query) {
        return $query->whereIsVisible(true);
    }

    public function scopeEntriable($query) {
        return $query->whereIsEntriable(true);
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    public function news()
    {
        return $this->hasMany(MeetNews::class, 'meet_id')->orderBy('created_at', 'DESC');
    }

    public function latestNews()
    {
        return $this->news()->latest()->firstOrNew();
    }

    protected function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y.m.d H:i');
    }

    public function raceInfo()
    {
        return $this->belongsTo(Media::class, 'race_info_id', 'uuid');
    }

    public function preStartlist()
    {
        return $this->belongsTo(Media::class, 'pre_startlist_id', 'uuid');
    }

    public function raceRecord()
    {
        return $this->belongsTo(Media::class, 'race_record_id', 'uuid');
    }

    public function timeSchedule()
    {
        return $this->belongsTo(Media::class, 'time_schedule_id', 'uuid');
    }

    public function getMediaFiles()
    {
        if($media = $this->raceInfo) {
            $this->raceInfo = new MediaResource($media);
        }

        if($media = $this->preStartlist) {
            $this->preStartlist = new MediaResource($media);
        }

        if($media = $this->raceRecord) {
            $this->raceRecord = new MediaResource($media);
        }

        if($media = $this->timeSchedule) {
            $this->timeSchedule = new MediaResource($media);
        }

        return $this;
    }
}
