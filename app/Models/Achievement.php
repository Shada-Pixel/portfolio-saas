<?php

namespace App\Models;

use App\Traits\SaveTenantID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\AboutMe
 *
 * @property int $id
 * @property string $title
 * @property string $achievement
 * @property string $icon
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement query()
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereAchievement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $color
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereColor($value)
 * @property string $short_description
 * @property string $dark_icon
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereDarkIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereShortDescription($value)
 * @property string $tenant_id
 * @property-read \App\Models\MultiTenant $tenant
 * @method static \Illuminate\Database\Eloquent\Builder|Achievement whereTenantId($value)
 */
class Achievement extends Model
{
    use HasFactory, BelongsToTenant, SaveTenantID;

    /**
     * @var string
     */
    protected $table = 'achievements';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'title',
        'short_description',
        'icon',
        'color',
        'dark_icon',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'title'             => 'string',
        'short_description' => 'string',
        'icon'              => 'string',
        'color'             => 'string',
        'dark_icon'         => 'string',
    ];

    /**
     * @var string[]
     */
    public static $rules = [
        'title'             => 'required|is_unique:achievements,title',
        'short_description' => 'required|max:155',
        'icon'              => 'required',
        'color'             => 'required',
        'dark_icon'         => 'required',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'tenant_id',
    ];

}
