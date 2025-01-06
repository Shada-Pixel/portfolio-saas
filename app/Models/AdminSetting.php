<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;
use Spatie\MediaLibrary\Models\Media;

/**
 * App\Models\AdminSetting
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property int $type
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read mixed $logo_url
 * @property-read MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[]
 *     $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|AdminSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminSetting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminSetting whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminSetting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminSetting whereValue($value)
 * @mixin \Eloquent
 */
class AdminSetting extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const GENERAL = 1;
    const SOCIAL_SETTING = 2;
    const PRIVACY_SETTING = 3;
    public const PATH = 'admin_settings';
    /**
     * @var string[]
     */
    public static $rules = [
        'company_name'  => 'required|string',
        'website'       => 'required|string',
        'phone'         => 'required|numeric',
        'address'       => 'required',
        'company_email' => 'required|email:filter',
    ];
    /**
     * @var string
     */
    protected $table = 'admin_settings';
    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'key',
        'value',
        'type',
    ];
    /**
     * @var string[]
     */
    protected $casts = [
        'id'    => 'integer',
        'key'   => 'string',
        'value' => 'string',
    ];

    /**
     * @return mixed
     */
    public function getLogoUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(AdminSetting::PATH)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return $this->value;
    }
}
