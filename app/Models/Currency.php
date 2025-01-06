<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

/**
 * App\Models\Currency
 *
 * @property int $id
 * @property string $currency_name
 * @property string $currency_icon
 * @property string $currency_code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read SubscriptionPlan|null $subscriptionPlan
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency query()
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCurrencyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCurrencyIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereCurrencyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Currency whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Currency extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['currency_name', 'currency_icon', 'currency_code'];

    /**
     * @var string
     */
    protected $table = 'currencies';

    /**
     *
     *
     * @return HasOne
     */
    public function subscriptionPlan()
    {
        return $this->hasOne(SubscriptionPlan::class);
    }
}
