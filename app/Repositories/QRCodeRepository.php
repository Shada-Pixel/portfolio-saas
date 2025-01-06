<?php

namespace App\Repositories;


use App\Models\QRCode;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * Class QRCodeRepository
 */
class QRCodeRepository extends BaseRepository
{

    /**
     * @var string[]
     */
    protected $fieldSearchable = [
        'id',
        'name',
        'url',
        'color',
        'size',
        'white_space',
        'style',
        'eye_style',
    ];

    /**
     * @inheritDoc
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * @inheritDoc
     */
    public function model()
    {
        return QRCode::class;
    }

    /**
     * @param $input
     *
     * @return mixed
     */
    public function generate($input)
    {
        $color = $this->convertRGBAColor($input['color']);
        $qrCode = \SimpleSoftwareIO\QrCode\Facades\QrCode::size($input['size'])
            ->color($color[0], $color[1], $color[2])
            ->margin($input['whiteSpace'])
            ->style($input['style'])
            ->eye($input['eyeStyle'])
            ->generate($input['userUrl']);

        return $qrCode;
    }

    /**
     * @param $qrCode
     *
     * @return mixed
     */
    public function qrCodeShow($qrCode)
    {
        $color = $this->convertRGBAColor($qrCode->color);
        $qrCodeImage = \SimpleSoftwareIO\QrCode\Facades\QrCode::size($qrCode->size)
            ->color($color[0], $color[1], $color[2])
            ->margin($qrCode->white_space)
            ->style($qrCode->style)
            ->eye($qrCode->eye_style)
            ->generate($qrCode->url);

        return $qrCodeImage;
    }

    /**
     * @param $color
     *
     * @return false|string[]
     */
    public function convertRGBAColor($color)
    {
        $replaceColor = str_replace(['rgba(', ')'], '', $color);
        $explodeColor = explode(',', $replaceColor);

        return $explodeColor;
    }

    /**
     * @param $qrCode
     *
     * @return mixed
     */
    public function qrCodeDownload($qrCode)
    {
        $color = $this->convertRGBAColor($qrCode->color);
        $qrCodeImage = \SimpleSoftwareIO\QrCode\Facades\QrCode::size($qrCode->size)
            ->color($color[0], $color[1], $color[2])
            ->margin($qrCode->white_space)
            ->style($qrCode->style)
            ->eye($qrCode->eye_style)
            ->format('svg')
            ->generate($qrCode->url);

        return $qrCodeImage;
    }
}
