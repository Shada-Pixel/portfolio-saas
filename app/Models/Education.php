<?php

namespace App\Models;

use App\Traits\SaveTenantID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Education
 *
 * @property-read \App\Models\City $city
 * @property-read \App\Models\Country $country
 * @property-read \App\Models\State $state
 * @method static \Illuminate\Database\Eloquent\Builder|Education newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Education newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Education query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $school_name
 * @property string $qualification
 * @property int $country_id
 * @property int $state_id
 * @property int $city_id
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @property bool $currently_studying_here
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereCurrentlyStudyingHere($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereQualification($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereSchoolName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereUpdatedAt($value)
 * @property string $tenant_id
 * @property-read \App\Models\MultiTenant $tenant
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereTenantId($value)
 */
class Education extends Model
{
    use HasFactory, BelongsToTenant, SaveTenantID;

    protected $table = 'educations';

    public $fillable = [
        'id',
        'school_name',
        'qualification',
        'country_id',
        'state_id',
        'city_id',
        'start_date',
        'end_date',
        'currently_studying_here',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'                      => 'integer',
        'country_id'              => 'integer',
        'state_id'                => 'integer',
        'city_id'                 => 'integer',
        'school_name'             => 'string',
        'qualification'           => 'string',
        'start_date'              => 'date',
        'end_date'                => 'date',
        'currently_studying_here' => 'boolean',
    ];

    const NOT_STUDY = 0;
    const STUDY = 1;
    const ALL = 2;

    const CURRENTLY_STUDY = [
//        self::ALL       => 'Select Study Here',
self::STUDY     => 'Currently study here',
self::NOT_STUDY => 'Currently not study here',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'school_name'   => 'required',
        'qualification' => 'required',
        'country_id'    => 'required',
        'state_id'      => 'required',
        'city_id'       => 'required',
        'start_date'    => 'required',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'tenant_id',
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
