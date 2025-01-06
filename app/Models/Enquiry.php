<?php

namespace App\Models;

use App\Traits\SaveTenantID;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Enquiry
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone
 * @property string $region_code
 * @property string $message
 * @property bool $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $full_name
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry query()
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereRegionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $tenant_id
 * @property-read \App\Models\MultiTenant $tenant
 * @method static \Illuminate\Database\Eloquent\Builder|Enquiry whereTenantId($value)
 */
class Enquiry extends Model
{
    use BelongsToTenant, SaveTenantID;

    public $table = 'enquiries';

    public $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'region_code',
        'message',
        'status',
    ];

    protected $appends = ['full_name'];

    const ALL = 2;
    const READ = 1;
    const UNREAD = 0;

    const STATUS_ARR = [
//        self::ALL    => 'Select Status',
self::READ   => 'Read',
self::UNREAD => 'Unread',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'          => 'integer',
        'first_name'  => 'string',
        'last_name'   => 'string',
        'email'       => 'string',
        'phone'       => 'string',
        'region_code' => 'string',
        'message'     => 'string',
        'status'      => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name' => 'required',
        'last_name'  => 'required',
        'email'      => 'required|email:filter',
        'phone'      => 'required|numeric',
        'message'    => 'required|max:5000',
    ];

    public static $reCaptchaAttributes = [
        'g-recaptcha-response' => 'Google reCaptcha'
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'tenant_id',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }
}
