<?php

namespace App\Models;

use App\Traits\SaveTenantID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\Skill
 *
 * @property int $id
 * @property string $name
 * @property string $percentage
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Skill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Skill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Skill query()
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Skill wherePercentage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $tenant_id
 * @property-read \App\Models\MultiTenant $tenant
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereTenantId($value)
 */
class Skill extends Model
{
    use HasFactory, BelongsToTenant, SaveTenantID;

    /**
     * @var string
     */
    protected $table = 'skills';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name', 'percentage',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'id'         => 'integer',
        'name'       => 'string',
        'percentage' => 'string',
    ];

    /**
     * @var string[]
     */
    public static $rules = [
        'name'       => 'required|string|max:15|is_unique:skills,name',
        'percentage' => 'required|numeric|max:100',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'tenant_id',
    ];
}
