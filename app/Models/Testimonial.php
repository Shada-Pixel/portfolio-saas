<?php

namespace App\Models;

use App\Traits\SaveTenantID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Testimonial
 *
 * @property int $id
 * @property string $name
 * @property string $position
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial query()
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read string $image_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @property string $tenant_id
 * @property-read \App\Models\MultiTenant $tenant
 * @method static \Illuminate\Database\Eloquent\Builder|Testimonial whereTenantId($value)
 */
class Testimonial extends Model implements HasMedia
{
    use HasFactory, BelongsToTenant, SaveTenantID;
    use InteractsWithMedia;

    /**
     * @var string
     */
    protected $table = 'testimonials';

    const IMAGE = 'testimonials';

    protected $appends = ['image_url'];

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'position',
        'description',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'id'          => 'integer',
        'name'        => 'string',
        'position'    => 'string',
        'description' => 'string',
    ];

    /**
     * @var string[]
     */
    public static $rules = [
        'name'        => 'required|string|max:255',
        'position'    => 'required',
        'description' => 'required|max:295',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'tenant_id',
    ];

    /**
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::IMAGE)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('img/infyom-logo.png');
    }
}
