<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class VCardAttribute
 *
 * @property int $id
 * @property int|null $v_card_id
 * @property string|null $icon
 * @property string|null $icon_color
 * @property string|null $label_text
 * @property string|null $value_text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|VCardAttribute newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VCardAttribute newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|VCardAttribute query()
 * @method static \Illuminate\Database\Eloquent\Builder|VCardAttribute whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VCardAttribute whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VCardAttribute whereIconColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VCardAttribute whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VCardAttribute whereLabelText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VCardAttribute whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VCardAttribute whereVCardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|VCardAttribute whereValueText($value)
 * @mixin \Eloquent
 */
class VCardAttribute extends Model
{
    use HasFactory;

    protected $table = "v_card_attributes";

    /**
     * @var string[]
     */
    protected $fillable = [
        'v_card_id',
        'icon',
        'icon_color',
        'label_text',
        'value_text',
    ];
}
