<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use App\Models\AdminSetting;
use App\Models\FrontCms;
use App\Models\Setting;
use App\Repositories\SettingRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Flash;
use Illuminate\Support\Facades\Redirect;

class SettingController extends AppBaseController
{
    /**
     * @var SettingRepository
     */
    private $settingRepo;

    /**
     * SettingController constructor.
     *
     * @param  SettingRepository  $settingRepository
     */
    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepo = $settingRepository;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request  $request
     *
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if (getLoggedInUser()->hasRole('super_admin')) {
            $settings = AdminSetting::toBase();
        } else {
            $settings = Setting::toBase();
        }
        $sectionName = ($request->section === null) ? 'general' : $request->section;

        if ($sectionName == 'general') {
            $settings = $settings->where('type',
                getLoggedInUser()->hasRole('super_admin') ? AdminSetting::GENERAL : Setting::GENERAL)
                ->pluck('value', 'key');
        }

        if ($sectionName == 'social-settings') {
            $settings = $settings->where('type', getLoggedInUser()->hasRole('super_admin') ?
                AdminSetting::SOCIAL_SETTING : Setting::SOCIAL_SETTING)->get()->toArray();
        }
        if ($sectionName == 'theme-settings') {
            $settings = $settings->where('type', Setting::THEME_SETTING)->get()->toArray();
        }

        if ($sectionName == 'privacy-settings') {
            $settings = $settings->where('type', AdminSetting::PRIVACY_SETTING)->pluck('value', 'key');
        }

        $sectionSix = FrontCms::toBase()->where('type', FrontCms::SECTION_SIX)->pluck('value', 'key');

        return view("settings.$sectionName", compact('settings', 'sectionName', 'sectionSix'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSettingRequest  $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function update(UpdateSettingRequest $request)
    {
        $input = $request->all();
        try {

            if (request()->get('sectionName') == 'general') {
                $input['region_code'] = isset($input['phone']) ? $input['region_code'] : getAdminSettingValue('default_region_code');
                $input['region_code_flag'] = isset($input['phone']) ? $input['region_code_flag'] : getAdminSettingValue('default_region_code_flag');
            }

            $this->settingRepo->updateSetting($input);

            Flash::success('Setting updated successfully.');
        } catch (\Exception $e) {
            Flash::error($e->getMessage());
        }
        
        return Redirect::back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSettingRequest  $request
     *
     * @return Application|RedirectResponse|Redirector
     */
    public function updateSocialSetting(UpdateSettingRequest $request)
    {
        $input = $request->all();
        try {
            $this->settingRepo->updateSetting($input);

            Flash::success('Setting updated successfully.');
        } catch (\Exception $e) {
            Flash::error($e->getMessage());
        }

        return Redirect::back();
    }

    /**
     * @param  Request  $request
     *
     * @return RedirectResponse
     */
    public function updateTheme(Request $request)
    {
        $input = $request->theme_layout;
        try {
            $this->settingRepo->updateTheme($input);

            Flash::success('Setting updated successfully.');
        } catch (\Exception $e) {
            Flash::error($e->getMessage());
        }

        return Redirect::back();
    }
}
