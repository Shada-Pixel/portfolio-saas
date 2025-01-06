<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PlanAttribute
 *
 * @property int $id
 * @property int $pricing_plan_id
 * @property string $attribute_icon
 * @property int $attribute_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAttribute whereAttributeIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAttribute whereAttributeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAttribute wherePricingPlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanAttribute whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PlanAttribute extends Model
{
    use HasFactory;

    protected $table = 'plan_attributes';

    public $fillable = [
        'id',
        'pricing_plan_id',
        'attribute_icon',
        'attribute_name',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'             => 'integer',
        'attribute_icon' => 'string',
        'attribute_name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'attribute_name' => 'required',
    ];
}
