<?php

namespace App\Models;

use \Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

/**
 * App\Models\Media
 *
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property string|null $uuid
 * @property string $collection_name
 * @property string $name
 * @property string $file_name
 * @property string|null $mime_type
 * @property string $disk
 * @property string|null $conversions_disk
 * @property int $size
 * @property array $manipulations
 * @property array $custom_properties
 * @property array $generated_conversions
 * @property array $responsive_images
 * @property int|null $order_column
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $extension
 * @property-read string $human_readable_size
 * @property-read mixed $original_url
 * @property-read mixed $preview_url
 * @property-read string $type
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $model
 * @property-read \App\Models\Meet $preStartlist
 * @property-read \App\Models\Meet|null $raceInfo
 * @property-read \App\Models\Meet $raceRecord
 * @property-read \App\Models\Meet $timeSchedule
 * @method static \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|static[] all($columns = ['*'])
 * @method static \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|static[] get($columns = ['*'])
 * @method static \Illuminate\Database\Eloquent\Builder|Media newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Media newQuery()
 * @method static Builder|Media ordered()
 * @method static \Illuminate\Database\Eloquent\Builder|Media query()
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCollectionName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereConversionsDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereCustomProperties($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereDisk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereGeneratedConversions($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereManipulations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereMimeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereOrderColumn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereResponsiveImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Media whereUuid($value)
 * @mixin \Eloquent
 */
class Media extends BaseMedia
{
    public function raceInfo()
    {
        return $this->hasOne(Meet::class, 'race_info_id', 'uuid');
    }

    public function preStartlist()
    {
        return $this->belongsTo(Meet::class, 'pre_startlist_id', 'uuid');
    }

    public function raceRecord()
    {
        return $this->belongsTo(Meet::class, 'race_record_id', 'uuid');
    }

    public function timeSchedule()
    {
        return $this->belongsTo(Meet::class, 'time_schedule_id', 'uuid');
    }
}
