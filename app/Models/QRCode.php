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
 * App\Models\QRCode
 *
 * @property int $id
 * @property string $name
 * @property string $url
 * @property string $color
 * @property string $size
 * @property string $white_space
 * @property string $style
 * @property string $eye_style
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|QRCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QRCode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|QRCode query()
 * @method static \Illuminate\Database\Eloquent\Builder|QRCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QRCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QRCode whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QRCode whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QRCode whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QRCode whereWhiteSpace($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QRCode whereStyle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QRCode whereEyeStyle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QRCode whereUpdatedAt($value)
 * @property string $tenant_id
 * @property-read string $image_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\MultiTenant $tenant
 * @method static \Illuminate\Database\Eloquent\Builder|QRCode whereTenantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|QRCode whereUrl($value)
 * @mixin \Eloquent
 */
class QRCode extends Model implements HasMedia
{
    use HasFactory, BelongsToTenant, SaveTenantID;
    use InteractsWithMedia;

    const IMAGE = 'qrcode';
    const TEXT = 1;
    const IMG = 2;

    public const STYLE = ['square' => 'Square', 'round' => 'Round', 'dot' => 'Dot'];
    public const  EYE_STYLE = ['square' => 'Square', 'circle' => 'Circle'];

    /**
     * @var string[]
     */
    public static $rules = [
        'name'        => 'required|string|max:30|is_unique:qr_codes,name',
        'url'         => 'required|url',
        'color'       => 'string|nullable',
        'size'        => 'string|nullable',
        'white_space' => 'string|nullable',
        'style'       => 'string|nullable',
        'eye_style'   => 'string|nullable',
    ];
    protected $table = "qr_codes";
    protected $appends = ['image_url'];
    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'url',
        'color',
        'size',
        'white_space',
        'style',
        'eye_style',
    ];
    /**
     * @var string[]
     */
    protected $casts = [
        'id'          => 'integer',
        'name'        => 'string',
        'url'         => 'string',
        'color'       => 'string',
        'size'        => 'string',
        'white_space' => 'string',
        'style'       => 'string',
        'eye_style'   => 'string',
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
