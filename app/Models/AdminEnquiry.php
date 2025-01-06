<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AdminEnquiry
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
 * @property-read string $full_name
 * @method static \Illuminate\Database\Eloquent\Builder|AdminEnquiry newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminEnquiry newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminEnquiry query()
 * @method static \Illuminate\Database\Eloquent\Builder|AdminEnquiry whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminEnquiry whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminEnquiry whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminEnquiry whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminEnquiry whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminEnquiry whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminEnquiry wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminEnquiry whereRegionCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminEnquiry whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AdminEnquiry whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AdminEnquiry extends Model
{
    use HasFactory;

    const ALL = 2;
    const READ = 1;
    const UNREAD = 0;
    const STATUS_ARR = [
        self::READ   => 'Read',
        self::UNREAD => 'Unread',
    ];
    /**
     * @var string[]
     */
    public static $rules = [
        'first_name' => 'required',
        'last_name'  => 'required',
        'email'      => 'required|email:filter',
        'phone'      => 'required|numeric',
        'message'    => 'required|max:5000',
    ];

    /**
     * @var string
     */
    public $table = 'admin_enquiries';

    /**
     * @var string[]
     */
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

    /**
     * @var string[]
     */
    protected $appends = ['full_name'];

    /**
     * @var string[]
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
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }
}
