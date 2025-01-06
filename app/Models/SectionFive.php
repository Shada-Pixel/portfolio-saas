<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\SectionFive
 *
 * @property int $id
 * @property string $text_main
 * @property string $text_secondary
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive query()
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive whereTextMain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive whereTextSecondary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SectionFive whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SectionFive extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public const FRONT_CMS_PATH = 'front_cms';

    /**
     * @var string[]
     */
    public static $rules = [
        'text_main'      => 'required|string|max:40',
        'text_secondary' => 'required|string|max:200',
    ];

    /**
     * @var string[]
     */
    public static $messages = [
        's5_main_image.max'        => 'The :attribute file size should not be greater than 2 MB',
        's5_main_image.dimensions' => 'The :attribute must be at least :min_width by :min_height pixels',
    ];

    /**
     * @var string[]
     */
    public static $customAttributes = [
        's5_text_title' => 'text title',
        's5_main_image' => 'image main',
    ];

    /**
     * @var string
     */
    protected $table = 'section_fives';
    /**
     * @var string[]
     */

    protected $fillable = [
        'id',
        'text_main',
        'text_secondary',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'id'             => 'integer',
        'text_main'      => 'string',
        'text_secondary' => 'string',
    ];
}
