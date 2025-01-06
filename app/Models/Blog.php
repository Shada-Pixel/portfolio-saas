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
 * App\Models\Blog
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $category_id
 * @property int|null $media_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category $category
 * @property-read string $image_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Blog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog query()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $slug
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereSlug($value)
 * @property int $is_published
 * @property int $is_featured
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereIsFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereIsPublished($value)
 * @property string $tenant_id
 * @property-read \App\Models\MultiTenant $tenant
 * @method static \Illuminate\Database\Eloquent\Builder|Blog isPublished()
 * @method static \Illuminate\Database\Eloquent\Builder|Blog whereTenantId($value)
 */
class Blog extends Model implements HasMedia
{
    use HasFactory, BelongsToTenant, SaveTenantID;
    use InteractsWithMedia;

    const PATH = 'blog_images';

    const PUBLISHED = 1;
    const DRAFT = 0;

    const FEATURED = 1;

    const STATUS = [
        self::PUBLISHED => 'Publish',
        self::DRAFT     => 'Draft',
    ];

    /**
     * @var string
     */
    protected $table = 'blogs';

    /**
     * @var string[]
     */
//    protected $with = ['media'];

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'title',
        'slug',
        'description',
        'category_id',
        'media_id',
        'is_published',
        'is_featured',
    ];

    /**
     * @var string[]
     */
    protected $appends = ['image_url'];

    /**
     * @var string[]
     */
    protected $casts = [
        'id'          => 'integer',
        'title'       => 'string',
        'slug'        => 'string',
        'description' => 'string',
        'media_id'    => 'integer',
        'category_id' => 'integer',
    ];

    /**
     * @var string[]
     */
    public static $rules = [
        'title'       => 'required',
        'slug'        => 'required|is_unique:blogs,slug',
        'description' => 'required',
        'category_id' => 'required',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'tenant_id',
    ];

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * @return string
     */
    public function getImageUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PATH)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('img/logo.png');
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeisPublished($query)
    {
        return $query->where('is_published', self::PUBLISHED);
    }
}
