<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\SubscriptionPlan
 *
 * @property int $id
 * @property string $name
 * @property int $currency_id
 * @property float $price
 * @property string $valid_until
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Currency $currency
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan whereCurrencyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan whereValidUntil($value)
 * @mixin \Eloquent
 * @property int $plan_type
 * @property-read \App\Models\Subscription|null $plan
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscription[] $plans
 * @property-read int|null $plans_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subscription[] $subscription
 * @property-read int|null $subscription_count
 * @method static \Illuminate\Database\Eloquent\Builder|SubscriptionPlan wherePlanType($value)
 */
class SubscriptionPlan extends Model
{
    use HasFactory;

    const  MONTH = 1;
    const  YEAR = 2;

    public const PLAN_TYPE = [
        1 => 'Month',
        2 => 'Year',
    ];

    public const PLAN_METHOD = [
        1 => 'Stripe',
        2 => 'PayPal',
    ];

    /**
     * @var string[]
     */
    public static $rules = [
        'name'        => 'required|max:50|unique:subscription_plans,name',
        'currency_id' => 'required',
        'price'       => 'required|max:4|gte:0',
        'plan_type'   => 'required',
        'valid_until' => 'required|digits_between:1,9999|gt:0',
    ];
    /**
     * @var string[]
     */
    public static $editRules = [
        'name'        => 'required|max:50|unique:subscription_plans,name',
        'currency_id' => 'required',
        'price'       => 'required|max:4|gte:0',
        'plan_type'   => 'required',
        'valid_until' => 'required|digits_between:1,9999|gt:0',
    ];
    /**
     * @var string[]
     */
    protected $fillable = ['name', 'currency_id', 'price', 'plan_type', 'valid_until'];
    /**
     * @var string
     */
    protected $table = 'subscription_plans';

    /**
     *
     * @return BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * @return HasOne
     */
    public function plan()
    {
        return $this->hasOne(Subscription::class)->latest();
    }

    /**
     * @return HasMany
     */
    public function plans()
    {
        return $this->hasMany(Subscription::class)->where('user_id', getLoggedInUserId());
    }

    /**
     * @return HasMany
     */
    public function subscription()
    {
        return $this->hasMany(Subscription::class)->where('status', '=', Subscription::ACTIVE);
    }
}
