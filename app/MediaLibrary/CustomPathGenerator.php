<?php

namespace App\MediaLibrary;

use App\Models\AdminSetting;
use App\Models\Blog;
use App\Models\FrontCms;
use App\Models\PricingPlan;
use App\Models\QRCode;
use App\Models\RecentWork;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\VCard;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

/**
 * Class CustomPathGenerator
 * @package App\MediaLibrary
 */
class CustomPathGenerator implements PathGenerator
{
    /**
     * @param  Media  $media
     *
     * @return string
     */
    public function getPath(Media $media): string
    {
        $path = '{PARENT_DIR}'.DIRECTORY_SEPARATOR.$media->id.DIRECTORY_SEPARATOR;

        switch ($media->collection_name) {
            case PricingPlan::ICON;
                return str_replace('{PARENT_DIR}', PricingPlan::ICON, $path);
            case RecentWork::ATTACHMENT;
                return str_replace('{PARENT_DIR}', RecentWork::ATTACHMENT, $path);
            case Service::ICON;
                return str_replace('{PARENT_DIR}', Service::ICON, $path);
            case Setting::PATH;
                return str_replace('{PARENT_DIR}', Setting::PATH, $path);
            case AdminSetting::PATH;
                return str_replace('{PARENT_DIR}', AdminSetting::PATH, $path);
            case User::PROFILE;
                return str_replace('{PARENT_DIR}', User::PROFILE, $path);
            case Blog::PATH;
                return str_replace('{PARENT_DIR}', Blog::PATH, $path);
            case Testimonial::IMAGE;
                return str_replace('{PARENT_DIR}', Testimonial::IMAGE, $path);
            case FrontCms::FRONT_CMS_PATH;
                return str_replace('{PARENT_DIR}', FrontCms::FRONT_CMS_PATH, $path);
            case VCARD::COVER_IMAGE;
                return str_replace('{PARENT_DIR}', VCARD::COVER_IMAGE, $path);
            case VCARD::PROFILE;
                return str_replace('{PARENT_DIR}', VCARD::PROFILE, $path);
            case QRCode::IMAGE;
                return str_replace('{PARENT_DIR}', QRCode::IMAGE, $path);
            case User::CODEIMAGE;
                return str_replace('{PARENT_DIR}', User::CODEIMAGE, $path);
            case 'default' :
                return '';
        }
    }

    /**
     * @param  Media  $media
     *
     * @return string
     */
    public function getPathForConversions(Media $media): string
    {
        return $this->getPath($media).'thumbnails/';
    }

    /**
     * @param  Media  $media
     *
     * @return string
     */
    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getPath($media).'rs-images/';
    }
}
