<?php

namespace App\Models;

use App\Traits\SaveTenantID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\PricingPlan
 *
 * @property int $id
 * @property string $name
 * @property int $media_id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $pricing_plan_type
 * @method static \Illuminate\Database\Eloquent\Builder|PricingPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PricingPlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PricingPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder|PricingPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PricingPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PricingPlan whereMediaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PricingPlan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PricingPlan whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PricingPlan whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $icon_image
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PlanAttribute[] $planAttributes
 * @property-read int|null $plan_attributes_count
 * @property string $color
 * @method static \Illuminate\Database\Eloquent\Builder|PricingPlan whereColor($value)
 * @property int $plan_type
 * @property string $price
 * @property int|null $currency_id
 * @property-read \App\Models\PlanCurrency|null $currency
 * @property-read string $plan_price_type
 * @method static \Illuminate\Database\Eloquent\Builder|PricingPlan whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PricingPlan wherePlanType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PricingPlan wherePrice($value)
 * @property string $tenant_id
 * @property-read \App\Models\MultiTenant $tenant
 * @method static \Illuminate\Database\Eloquent\Builder|PricingPlan whereTenantId($value)
 */
class PricingPlan extends Model implements HasMedia
{
    use HasFactory, BelongsToTenant, SaveTenantID;
    use InteractsWithMedia;

    protected $table = 'pricing_plans';

    const ICON = 'pricing_plan';

    protected $with = ['media'];

    public $fillable = [
        'id',
        'name',
        'media_id',
        'type',
        'color',
        'plan_type',
        'price',
        'currency_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'        => 'integer',
        'name'      => 'string',
        'media_id'  => 'integer',
        'type'      => 'string',
        'color'     => 'string',
        'plan_type' => 'integer',
    ];

    protected $appends = ['pricing_plan_type', 'icon_image', 'plan_price_type'];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name'        => 'required|is_unique:pricing_plans,name',
        'type'        => 'required',
        'plan_type'   => 'required',
        'price'       => 'required',
        'currency_id' => 'required',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'tenant_id',
    ];

    const PROFESSIONAL = 1;
    const ADVANCED = 2;
    const PREMIUM = 3;
    const ALL = 0;

    const MONTHLY = 1;
    const YEARLY = 2;
    const WEEKLY = 3;

    const PRICING_PLAN_TYPE_ARRAY = [
//        self::ALL          => 'Select Type',
self::PROFESSIONAL => 'Professional',
self::ADVANCED     => 'Advance',
self::PREMIUM      => 'Premium',
    ];

    const PRICING_PLAN_TYPE = [
        self::PROFESSIONAL => 'Professional',
        self::ADVANCED     => 'Advance',
        self::PREMIUM      => 'Premium',
    ];

    const PLAN_TYPE_ARRAY = [
//        self::ALL     => 'Select Plan Type',
self::MONTHLY => 'Month',
self::YEARLY  => 'Year',
self::WEEKLY  => 'Week',
    ];

    const PLAN_TYPE = [
        self::MONTHLY => 'Month',
        self::YEARLY  => 'Year',
        self::WEEKLY  => 'Week',
    ];

    /**
     * @return string
     */
    public function getPricingPlanTypeAttribute()
    {
        return self::PRICING_PLAN_TYPE[$this->type];
    }

    /**
     * @return string
     */
    public function getPlanPriceTypeAttribute()
    {
        return self::PLAN_TYPE[$this->plan_type];
    }

    /**
     * @return mixed
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

    /**
     * @return HasMany
     */
    public function planAttributes()
    {
        return $this->hasMany(PlanAttribute::class, 'pricing_plan_id');
    }

    /**
     * @return BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(PlanCurrency::class, 'currency_id');
    }
}
