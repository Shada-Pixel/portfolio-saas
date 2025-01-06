<?php

namespace App\Models;

use App\Traits\SaveTenantID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Experience
 *
 * @property int $id
 * @property string $job_title
 * @property string $company
 * @property string $title
 * @property int $country_id
 * @property int $state_id
 * @property int $city_id
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property int $currently_work_here
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\City $city
 * @property-read \App\Models\Country $country
 * @property-read \App\Models\State $state
 * @method static \Illuminate\Database\Eloquent\Builder|Experience newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Experience newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Experience query()
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereCurrentlyWorkHere($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereJobTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $tenant_id
 * @property-read \App\Models\MultiTenant $tenant
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereTenantId($value)
 */
class Experience extends Model
{
    use HasFactory, BelongsToTenant, SaveTenantID;

    protected $table = 'experiences';

    public $fillable = [
        'id',
        'job_title',
        'company',
        'country_id',
        'state_id',
        'city_id',
        'start_date',
        'end_date',
        'currently_work_here',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'         => 'integer',
        'country_id' => 'integer',
        'state_id'   => 'integer',
        'city_id'    => 'integer',
        'job_title'  => 'string',
        'company'    => 'string',
        'start_date' => 'date',
        'end_date'   => 'date',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'job_title'  => 'required',
        'company'    => 'required',
        'country_id' => 'required',
        'state_id'   => 'required',
        'city_id'    => 'required',
        'start_date' => 'required',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'tenant_id',
    ];

    const NOT_WORK = 0;
    const WORK = 1;
    const ALL = 2;

    const CURRENTLY_WORK = [
//        self::ALL      => 'Select Work Here',
self::WORK     => 'Currently work',
self::NOT_WORK => 'Currently not work',
    ];

    /**
     * @return BelongsTo
     **/
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * @return belongsTo
     **/
    public function city(): belongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * @return belongsTo
     **/
    public function state(): belongsTo
    {
        return $this->belongsTo(State::class, 'state_id');
    }
}
