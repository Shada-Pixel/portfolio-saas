<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Class Subscription
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $stripe_id
 * @property string $stripe_status
 * @property string|null $stripe_plan
 * @property int|null $subscription_plan_id
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read SubscriptionPlan|null $SubscriptionPlan
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereCurrentEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereCurrentStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereSubscriptionPlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereStripePlan($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereStripeStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Subscription whereUserId($value)
 * @property string|null $transaction_id
 * @property int|null $type 1: Stripe, 2: Paypal
 * @property float|null $amount
 * @property array|null $meta
 * @property-read \App\Models\SubscriptionPlan|null $subscriptionPlan
 * @method static Builder|Subscription whereAmount($value)
 * @method static Builder|Subscription whereEndDate($value)
 * @method static Builder|Subscription whereMeta($value)
 * @method static Builder|Subscription whereStartDate($value)
 * @method static Builder|Subscription whereStatus($value)
 * @method static Builder|Subscription whereTransactionId($value)
 * @method static Builder|Subscription whereType($value)
 * @method static Builder|Subscription whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Subscription extends Model
{
    use HasFactory;

    const ACTIVE = 1;
    const INACTIVE = 0;

    const TYPE_STRIPE = 1;
    const TYPE_PAYPAL = 2;

    const PAYMENT_TYPES = [
        self::TYPE_STRIPE => 'Stripe',
        self::TYPE_PAYPAL => 'PayPal',
    ];

    public $fillable = [
        'user_id', 'subscription_plan_id', 'transaction_id', 'type', 'amount',
        'meta', 'start_date', 'end_date', 'status',
    ];

    /**
     * @var string
     */
    protected $table = 'subscriptions';

    /**
     * @var string[]
     */
    protected $casts = [
        'user_id'              => 'integer',
        'subscription_plan_id' => 'integer',
        'transaction_id'       => 'string',
        'type'                 => 'integer',
        'amount'               => 'double',
        'meta'                 => 'json',
        'start_date'           => 'timestamp',
        'end_date'             => 'timestamp',
        'status'               => 'boolean',
    ];

    /**
     * @return BelongsTo
     */
    public function subscriptionPlan()
    {
        return $this->belongsTo(SubscriptionPlan::class, 'subscription_plan_id');
    }
}
