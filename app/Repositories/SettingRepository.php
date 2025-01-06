<?php

namespace App\Repositories;

use App\Models\AdminSetting;
use App\Models\FrontCms;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class SettingRepository
 */
class SettingRepository extends BaseRepository
{
    /**
     * @var string[]
     */
    protected $fieldSearchable = [
        'key',
        'value',
    ];

    /**
     * @return array|void
     */
    public function getFieldsSearchable()
    {
        $this->fieldSearchable;
    }

    /**
     * @return string
     */
    public function model()
    {
        return Setting::class;
    }

    /**
     * @param $input
     *
     * @return bool
     */
    public function updateSetting($input)
    {
        $settingInputArray = Arr::except($input, ['_token']);

        if ($input['sectionName'] == 'social-settings') {
            $this->updateSocialSetting(Arr::only($input, ['key', 'value']));
            $this->updateSectionSix($input);

            return true;
        }
        
        foreach ($settingInputArray as $key => $value) {
            if (getLoggedInUser()->hasRole('super_admin')) {
                /** @var AdminSetting $setting */
                $setting = AdminSetting::where('key', $key)->first();
            } else {
                /** @var Setting $setting */
                $setting = Setting::where('key', $key)->first();
            }
            if (! $setting) {
                continue;
            }
            if (in_array($key, ['company_logo', 'favicon']) && ! empty($value)) {
                $this->fileUpload($setting, $value);
                continue;
            }
            $setting->update(['value' => $value]);
        }

        return true;
    }

    /**
     * @param $input
     *
     *
     * @return bool
     */
    public function updateSectionSix($input)
    {
        if (getLoggedInUser()->hasRole('super_admin')) 
        {
            $inputArray = Arr::only($input, ['s6_text_title', 's6_text_secondary']);

            foreach ($inputArray as $key => $value) {
                $frontCmsSetting = FrontCms::where('key', $key)->first();
                $frontCmsSetting->update(['value' => $value]);
            }
        }

        return true;
    }

    /**
     * @param $input
     *
     * @return bool
     */
    public function updateSocialSetting($input)
    {
        $inputArray = prepareInputArray($input);
        try {
            DB::beginTransaction();

            if (getLoggedInUser()->hasRole('super_admin')) {
                /** @var AdminSetting $adminSetting */
                AdminSetting::where('type', AdminSetting::SOCIAL_SETTING)->delete();
            } else {
                /** @var Setting $setting */
                Setting::where('type', Setting::SOCIAL_SETTING)->delete();
            }

            foreach ($inputArray as $key => $data) {
                if (getLoggedInUser()->hasRole('super_admin')) {
                    $data['type'] = AdminSetting::SOCIAL_SETTING;
                    AdminSetting::create($data);
                } else {
                    $data['type'] = Setting::SOCIAL_SETTING;
                    Setting::create($data);
                }
            }
            DB::commit();

            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $setting
     *
     * @param $file
     *
     * @return mixed
     */
    public function fileUpload($setting, $file)
    {
        if (getLoggedInUser()->hasRole('super_admin')) {
            $setting->clearMediaCollection(AdminSetting::PATH);
        } else {
            $setting->clearMediaCollection(Setting::PATH);
        }
        $media = $setting->addMedia($file)->toMediaCollection(
            getLoggedInUser()->hasRole('super_admin') ? AdminSetting::PATH : Setting::PATH, config('app.media_disc'));
        $setting->update(['value' => $media->getUrl()]);

        return $setting;
    }


    /**
     * @param $input
     *
     * @return mixed
     */
    public function updateTheme($input)
    {
        $setting = Setting::where('key', 'theme_layout')->first();
        if ($setting == null) {
            $userSettings = [
                'key'        => 'theme_layout', 'value' => ! empty($input) ? $input : Setting::TEMPLATE_ONE,
                'type'       => Setting::THEME_SETTING,
                'created_at' => Carbon::now(), 'updated_at' => Carbon::now(),
                'tenant_id'  => getLoggedInUser()->tenant_id,
            ];
            Setting::insert($userSettings);
        } else {
            $setting->update(['value' => $input]);
        }

        return $setting;
    }
}
