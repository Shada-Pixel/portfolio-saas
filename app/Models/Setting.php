<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\Models\Media;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Setting
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property int $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $logo_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[]
 *     $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereValue($value)
 * @mixin \Eloquent
 * @property string $tenant_id
 * @property-read \App\Models\MultiTenant $tenant
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereTenantId($value)
 */
class Setting extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia, BelongsToTenant;

    /**
     * @var string
     */
    protected $table = 'settings';

    const GENERAL = 1;
    const SOCIAL_SETTING = 2;
    const THEME_SETTING = 3;
    const TEMPLATE_ONE = 1;
    const TEMPLATE_TWO = 2;
    const TEMPLATE_THREE = 3;

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'key',
        'value',
        'type',
    ];

    public const PATH = 'settings';

    /**
     * @var string[]
     */
    protected $casts = [
        'id'    => 'integer',
        'key'   => 'string',
        'value' => 'string',
    ];

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
     * @var string[]
     */
    public static $adminRules = [
        'company_name'     => 'required|string',
        'website'          => 'required|string',
        'phone'            => 'required',
        'address'          => 'required',
        'company_email'    => 'required|email:filter',
        'contact_us'       => 'required|max:250',
    ];

    public static $socialSetting = [
        's6_text_title'          => 'text title',
        's6_text_secondary'      => 'text secondary',
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
    public function getLogoUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(Setting::PATH)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return $this->value;
    }
}
