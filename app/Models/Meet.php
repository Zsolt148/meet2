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
 * @property string|null $entry_app
 * @property int $entry_price
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereEntryPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereEntryType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereIsEntriable($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Event[] $events
 * @property-read int|null $events_count
 * @method static \Illuminate\Database\Eloquent\Builder|Meet entriable()
 * @method static \Illuminate\Database\Eloquent\Builder|Meet whereEntryApp($value)
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

    protected $appends = [
        'is_deadline_ok'
    ];

    const ENTRY_TYPE_SENIOR = 'senior';

    const ENTRY_TYPES = [
        self::ENTRY_TYPE_SENIOR,
    ];

    const ENTRY_APP_MEET_MANAGER_CSV = 'meetmanager - csv';
    const ENTRY_APP_SWIMMING = 'uszas';

    const ENTRY_APPS = [
        self::ENTRY_APP_MEET_MANAGER_CSV,
        //self::ENTRY_APP_SWIMMING,
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeVisible($query) {
        return $query->whereIsVisible(true);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeEntriable($query) {
        return $query->whereIsEntriable(true);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact()
    {
        return $this->belongsTo(Contact::class, 'contact_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function news()
    {
        return $this->hasMany(MeetNews::class, 'meet_id')->orderBy('created_at', 'DESC');
    }

    /**
     * @return Model
     */
    public function latestNews()
    {
        return $this->news()->latest()->firstOrNew();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function events()
    {
        return $this->belongsToMany(Event::class, 'meet_event', 'meet_id', 'event_id')
            ->using(MeetEvent::class)
            ->withPivot('order', 'category')
            ->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function entries() 
    {
        return $this->hasMany(Entry::class, 'meet_id')
            ->with('competitor', 'meetEvent', 'user');
    }

    /**
     * @param $date
     * @return string
     */
    protected function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y.m.d H:i');
    }

    /**
     * @param $date
     * @return string
     */
    protected function getDeadlineAttribute($date)
    {
        return Carbon::parse($date)->format('Y.m.d');
    }

    /**
     * @param $date
     * @return string
     */
    protected function setDeadlineAttribute($date)
    {
        //TODO check addDay timezone
        $this->attributes['deadline'] = Carbon::parse($date)->addDay()->format('Y-m-d');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function raceInfo()
    {
        return $this->belongsTo(Media::class, 'race_info_id', 'uuid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function preStartlist()
    {
        return $this->belongsTo(Media::class, 'pre_startlist_id', 'uuid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function raceRecord()
    {
        return $this->belongsTo(Media::class, 'race_record_id', 'uuid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function timeSchedule()
    {
        return $this->belongsTo(Media::class, 'time_schedule_id', 'uuid');
    }

    /**
     * @return $this
     */
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

    public function isEntriable()
    {
        return $this->is_entriable;
    }

    public function isEntryPriceSet()
    {
        return $this->entry_price !== 0;
    }

    public function getIsDeadlineOkAttribute()
    {
        return Carbon::createFromFormat('Y.m.d', $this->deadline)->endOfDay()->greaterThanOrEqualTo(Carbon::now());
    }
}
