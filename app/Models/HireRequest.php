<?php

namespace App\Models;

use App\Traits\SaveTenantID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\HireRequest
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $mobile
 * @property string $company_name
 * @property string $interested_in
 * @property string $budget
 * @property string|null $region_code
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|HireRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HireRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|HireRequest query()
 * @method static \Illuminate\Database\Eloquent\Builder|HireRequest whereBudget($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HireRequest whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HireRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HireRequest whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HireRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HireRequest whereInterestedIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HireRequest whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HireRequest whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HireRequest whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HireRequest whereRegionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|HireRequest whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $tenant_id
 * @property-read \App\Models\MultiTenant $tenant
 * @method static \Illuminate\Database\Eloquent\Builder|HireRequest whereTenantId($value)
 */
class HireRequest extends Model
{
    use HasFactory, BelongsToTenant, SaveTenantID;

    /**
     * @var string
     */
    protected $table = 'hire_requests';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'mobile',
        'company_name',
        'interested_in',
        'budget',
        //        'region_code',
        'message',
    ];

    /**
     * @var string[]
     */
    public static $rules = [
        'name'          => 'required',
        'email'         => 'required|email:filter',
        'company_name'  => 'required',
        'interested_in' => 'required',
        'budget'        => 'required',
        'message'       => 'required',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'tenant_id',
    ];
}
