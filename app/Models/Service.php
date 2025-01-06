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
 * App\Models\Service
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $icon_image
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service query()
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $color
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereColor($value)
 * @property string $tenant_id
 * @property-read \App\Models\MultiTenant $tenant
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereTenantId($value)
 */
class Service extends Model implements HasMedia
{
    use HasFactory, BelongsToTenant, SaveTenantID;
    use InteractsWithMedia;

    const ICON = 'services';

    /**
     * @var string
     */
    protected $table = 'services';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'color',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'name'        => 'string',
        'color'       => 'string',
        'description' => 'string',
    ];

    /**
     * @var string[]
     */
    protected $appends = ['icon_image'];


    protected $with = ['media'];

    /**
     * @var string[]
     */
    public static $rules = [
        'name'        => 'required|is_unique:services,name',
        'color'       => 'required',
        'description' => 'required|max:355',
    ];

    protected $hidden = [
        'tenant_id',
    ];

    /**
     *
     * @return string
     */
    public function getIconImageAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::ICON)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('img/infyom-logo.png');
    }
}
