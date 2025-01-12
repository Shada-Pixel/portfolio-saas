<?php

namespace App\Models;

use App\Traits\SaveTenantID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\RecentWork
 *
 * @property int $id
 * @property int $type_id
 * @property string $title
 * @property string|null $link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $attachment_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\RecentWorkType $type
 * @method static \Illuminate\Database\Eloquent\Builder|RecentWork newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RecentWork newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RecentWork query()
 * @method static \Illuminate\Database\Eloquent\Builder|RecentWork whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecentWork whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecentWork whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecentWork whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecentWork whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecentWork whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $media_full_url
 * @property-read mixed $media_url_arr
 * @property string $tenant_id
 * @property-read \App\Models\MultiTenant $tenant
 * @method static \Illuminate\Database\Eloquent\Builder|RecentWork whereTenantId($value)
 */
class RecentWork extends Model implements HasMedia
{
    use HasFactory, BelongsToTenant, SaveTenantID;
    use InteractsWithMedia;

    protected $table = 'recent_works';

    const ATTACHMENT = 'recent_work';

    protected $appends = ['attachment_url', 'media_url_arr', 'media_full_url'];

    public $fillable = [
        'id',
        'type_id',
        'title',
        'link',
        'video_link',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'      => 'integer',
        'type_id' => 'integer',
        'title'   => 'string',
        'link'    => 'string',
    ];


    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'type_id' => 'required',
        'title'   => 'required',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'tenant_id',
    ];

    /**
     * @return mixed
     */
    public function getAttachmentUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::ATTACHMENT)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('img/recent-work.jpeg');
    }

    public function getMediaUrlArrAttribute()
    {
        $mediaUrl = [];
        /** @var Media $media */
        $medias = $this->getMedia(self::ATTACHMENT);

        foreach ($medias as $index => $media) {
            $mediaUrl[] = $media->getFullUrl();
        }

        if (! empty($mediaUrl)) {
            return $mediaUrl;
        }

        return '';
    }

    public function getMediaFullUrlAttribute()
    {
        $mediaUrl = [];
        /** @var Media $media */
        $medias = $this->getMedia(self::ATTACHMENT);

        foreach ($medias as $index => $media) {
            $mediaUrl[$media->id] = $media->getFullUrl();
        }

        if (! empty($mediaUrl)) {
            return $mediaUrl;
        }

        return '';
    }

    /**
     * @return BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(RecentWorkType::class, 'type_id');
    }
}
