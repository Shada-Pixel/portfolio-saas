<?php

namespace App\Models;

use App\Traits\SaveTenantID;
use Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;
use Str;

/**
 * App\Models\VCard
 *
 * @property int $id
 * @property string $template_id
 * @property string $v_card_name
 * @property string $name
 * @property string $occupation
 * @property string $introduction
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VCard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VCard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VCard query()
 * @method static \Illuminate\Database\Eloquent\Builder|VCard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VCard whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VCard whereVCardUniqueId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VCard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VCard whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VCard whereVCaraName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VCard whereOccupation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VCard whereIntroduction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VCard whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VCard whereValidUntil($value)
 * @property string $v_card_unique_id
 * @property string $tenant_id
 * @property-read mixed $cover_image
 * @property-read mixed $profile_image
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @property-read \App\Models\MultiTenant $tenant
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\VCardAttribute[] $vCardAttributes
 * @property-read int|null $v_card_attributes_count
 * @method static Builder|VCard whereTenantId($value)
 * @method static Builder|VCard whereVCardName($value)
 * @mixin \Eloquent
 */
class VCard extends Model implements HasMedia
{
    use HasFactory, BelongsToTenant, SaveTenantID;
    use InteractsWithMedia;

    protected $table = "v_cards";

    protected $with = ['media'];

    protected $appends = ['cover_image', 'profile_image'];

    const COVER_IMAGE = 'cover_image';
    const PROFILE = 'profile';
    const TEMPLATE = [
        1 => 'front.vcards.cards.vcard_one',
        2 => 'front.vcards.cards.vcard_two',
        3 => 'front.vcards.cards.vcard_three',
        4 => 'front.vcards.cards.vcard_four',
        5 => 'front.vcards.cards.vcard_five',
    ];
    
    const VCARDIMAGES = [
        1 => 'assets/web/css/images/vcard-one.jpeg',
        2 => 'assets/web/css/images/vcardtwo.jpeg',
        3 => 'assets/web/css/images/card_three.jpeg',
        4 => 'assets/web/css/images/vcard_four.jpeg',
        5 => 'assets/web/css/images/vcard_five.jpeg',
    ];
    
    /**
     * @var string[]
     */
    public static $rules = [
        'template_id'  => 'required',
        'v_card_name'  => 'required|max:20',
        'name'         => 'required|string|max:30',
        'occupation'   => 'required|string|max:30',
        'introduction' => 'required|max:200',
        'icon'         => 'nullable',
        'icon_color'   => 'nullable',
        'label_text'   => 'nullable',
        'value_text'   => 'nullable',
    ];

    /**
     * @var string[] 
     */
    protected $hidden = [
        'tenant_id',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'v_card_name', 'name', 'occupation', 'introduction', 'template_id', 'v_card_unique_id',
    ];

    /**
     * @return mixed
     */
    public function getProfileImageAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PROFILE)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }
    }

    /**
     * @return mixed
     */
    public function getCoverImageAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::COVER_IMAGE)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }
    }

    /**
     * @return HasMany
     */
    public function vCardAttributes()
    {
        return $this->hasMany(VCardAttribute::class, 'v_card_id');
    }

    /**
     * @return array|false|string|string[]|null
     */
    public static function generateUniqueVCardUniqueId()
    {
        $VCardUniqueId = mb_strtoupper(Str::random(20));
        while (true) {
            $isExist = VCard::whereVCardUniqueId($VCardUniqueId)->exists();
            if ($isExist) {
                self::generateUniqueVCardUniqueId();
            }
            break;
        }

        return $VCardUniqueId;
    }
}
