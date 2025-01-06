<?php

namespace App\Models;

use App\Traits\SaveTenantID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

/**
 * App\Models\RecentWorkType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|RecentWorkType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RecentWorkType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|RecentWorkType query()
 * @method static \Illuminate\Database\Eloquent\Builder|RecentWorkType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecentWorkType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecentWorkType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|RecentWorkType whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\RecentWork[] $recentWorks
 * @property-read int|null $recent_works_count
 * @property string $tenant_id
 * @property-read \App\Models\MultiTenant $tenant
 * @method static \Illuminate\Database\Eloquent\Builder|RecentWorkType whereTenantId($value)
 */
class RecentWorkType extends Model
{
    use HasFactory, BelongsToTenant, SaveTenantID;

    /**
     * @var string
     */
    protected $table = 'recent_work_types';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'id'   => 'integer',
        'name' => 'string',
    ];

    /**
     * @var string[]
     */
    public static $rules = [
        'name' => 'required|string|is_unique:recent_work_types,name',
    ];

    /**
     * @var string[]
     */
    protected $hidden = [
        'tenant_id',
    ];

    /**
     * @return HasMany
     */
    public function recentWorks()
    {
        return $this->hasMany(RecentWork::class, 'type_id')->with('media');

    }
}
