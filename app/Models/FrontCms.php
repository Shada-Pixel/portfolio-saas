<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * App\Models\FrontCms
 *
 * @property int $id
 * @property string $key
 * @property string|null $value
 * @property int $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $attachment_url
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|FrontCms newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontCms newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontCms query()
 * @method static \Illuminate\Database\Eloquent\Builder|FrontCms whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontCms whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontCms whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontCms whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontCms whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FrontCms whereValue($value)
 * @mixin \Eloquent
 */
class FrontCms extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const SECTION_ONE = 1;
    const SECTION_TWO = 2;
    const SECTION_FOUR = 4;
    const SECTION_THREE = 3;
    const SECTION_FIVE= 5;
    const SECTION_SIX = 6;

    public const FRONT_CMS_PATH = 'front_cms';

    /**
     * @var string[]
     */
    public static $sectionOneRules = [
        'text_title'       => 'required|string|max:30',
        'text_main_one'    => 'required|string|max:9',
        'text_main_two'    => 'required|string|max:9',
        'text_main_three'  => 'nullable|string|max:9',
        'text_main_four'   => 'nullable|string|max:9',
        'text_main_five'   => 'nullable|string|max:9',
        'text_secondary'   => 'required|string|max:255',
    ];

    public static $sectionOneCustomMessages = [
        'text_title.max' => 'The :attribute must not be greater than :max characters.',
    ];

    public static $sectionOneCustomAttributes = [
        'text_title'     => 'text title',
        'text_main_one'  => 'text main one',
        'text_main_two'  => 'text main two',
        'text_main_three'  => 'text main three',
        'text_main_four'  => 'text main four',
        'text_main_five'  => 'text main five',
        'text_secondary' => 'text secondary',
    ];

    /**
     * @var string[]
     */
    public static $sectionTwoRules = [
        's2_text_title'          => 'required|string|max:45',
        's2_text_secondary'      => 'required|string|max:200',
        's2_link_one_text'       => 'required|string|max:10',
        's2_link_one_link'       => 'required|url',
        's2_link_two_text'       => 'required|string|max:10',
        's2_link_two_link'       => 'required|url',
        's2_counter_one_value'   => 'required|integer|between:1,100',
        's2_counter_one_text'    => 'required|string|max:25',
        's2_counter_two_value'   => 'required|integer|between:1,100',
        's2_counter_two_text'    => 'required|string|max:25',
        's2_counter_three_value' => 'required|integer|between:1,100',
        's2_counter_three_text'  => 'required|string|max:25',
        's2_background_image'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];

    /**
     * @var string[]
     */
    public static $sectionFourRules = [
        's4_text_title'          => 'required|string|max:30',
        's4_text_secondary'      => 'required|string|max:200',
        's4_img_one'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=50,min_height=50',
        's4_img_one_text'        => 'required|string|max:25',
        's4_img_one_text_two'    => 'required|string|max:200',
        's4_img_two'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=50,min_height=50',
        's4_img_two_text'        => 'required|string|max:25',
        's4_img_two_text_two'    => 'required|string|max:200',
        's4_img_three'           => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=50,min_height=50',
        's4_img_three_text'      => 'required|string|max:25',
        's4_img_three_text_two'  => 'required|string|max:200',
        's4_img_four'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=50,min_height=50',
        's4_img_four_text'       => 'required|string|max:25',
        's4_img_four_text_two'   => 'required|string|max:200',
        's4_img_five'            => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=50,min_height=50',
        's4_img_five_text'       => 'required|string|max:25',
        's4_img_five_text_two'   => 'required|string|max:200',
        's4_img_six'             => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=50,min_height=50',
        's4_img_six_text'        => 'required|string|max:25',
        's4_img_six_text_two'    => 'required|string|max:200',
    ];
    
    public static $sectionTwoCustomMessages = [
        's2_background_image.max'        => 'The :attribute file size should not be greater than 2 MB',
        's2_background_image.dimensions' => 'The :attribute must be at least :min_width by :min_height pixels',
    ];

    public static $sectionTwoCustomAttributes = [
        's2_text_title'          => 'text title',
        's2_text_secondary'      => 'text secondary',
        's2_link_one_text'       => 'link one text',
        's2_link_one_link'       => 'link one link',
        's2_link_two_text'       => 'link two text',
        's2_link_two_link'       => 'link two link',
        's2_counter_one_value'   => 'counter one value',
        's2_counter_one_text'    => 'counter one text',
        's2_counter_two_value'   => 'counter two value',
        's2_counter_two_text'    => 'counter one text',
        's2_counter_three_value' => 'counter three value',
        's2_counter_three_text'  => 'counter three text',
        's2_background_image'    => 'background image',
    ];
    
    public static $sectionFourCustomMessages = [
        's4_img_one.max'          => 'The :attribute file size should not be greater than 2 MB',
        's4_img_one.dimensions'   => 'The :attribute must be at least :min_width by :min_height pixels',
        's4_img_two.max'          => 'The :attribute file size should not be greater than 2 MB',
        's4_img_two.dimensions'   => 'The :attribute must be at least :min_width by :min_height pixels',
        's4_img_three.max'        => 'The :attribute file size should not be greater than 2 MB',
        's4_img_three.dimensions' => 'The :attribute must be at least :min_width by :min_height pixels',
        's4_img_four.max'         => 'The :attribute file size should not be greater than 2 MB',
        's4_img_four.dimensions'  => 'The :attribute must be at least :min_width by :min_height pixels',
        's4_img_five.max'         => 'The :attribute file size should not be greater than 2 MB',
        's4_img_five.dimensions'  => 'The :attribute must be at least :min_width by :min_height pixels',
        's4_img_six.max'          => 'The :attribute file size should not be greater than 2 MB',
        's4_img_six.dimensions'   => 'The :attribute must be at least :min_width by :min_height pixels',
    ];

    public static $sectionFiveCustomMessages = [
        's5_main_image.max'          => 'The :attribute file size should not be greater than 2 MB',
        's5_main_image.dimensions'   => 'The :attribute must be at least :min_width by :min_height pixels',
    ];

    public static $sectionFiveCustomAttributes = [
        's5_text_title'                 => 'text title',
        's5_main_image'                 => 'Main Image',
        's5_one_text_one'               => 'Main one Text One',
        's5_one_text_two'               => 'Main one Text Two',
    ];
    
    /**
     * @var string
     */
    protected $table = 'front_cms';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'key',
        'value',
        'type',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'id'    => 'integer',
        'key'   => 'string',
        'value' => 'string',
    ];

    /**
     * @return mixed
     */
    public function getAttachmentUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(FrontCms::FRONT_CMS_PATH)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return $this->value;
    }
}
