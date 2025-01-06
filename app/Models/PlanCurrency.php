<?php

namespace App\Models;

use App\Traits\SaveTenantID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\PlanCurrency
 *
 * @property int $id
 * @property string $currency_name
 * @property string $currency_code
 * @property string $currency_icon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PlanCurrency newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanCurrency newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanCurrency query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanCurrency whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanCurrency whereCurrencyCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanCurrency whereCurrencyIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanCurrency whereCurrencyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanCurrency whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanCurrency whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $tenant_id
 * @property-read \App\Models\MultiTenant $tenant
 * @method static \Illuminate\Database\Eloquent\Builder|PlanCurrency whereTenantId($value)
 */
class PlanCurrency extends Model
{
    use HasFactory, BelongsToTenant, SaveTenantID;

    protected $table = 'plan_currencies';

    /**
     * @var string[]
     */
    protected $fillable = [
        'currency_name', 'currency_code', 'currency_icon',
    ];

    /**
     * @var string[]
     */
    public static $rules = [
        'currency_name' => 'required',
        'currency_code' => 'required',
        'currency_icon' => 'required',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'tenant_id',
    ];
}
