<?php

namespace App\Repositories;

use App\Models\AdminSetting;
use App\Models\FavoritePortfolio;
use App\Models\FrontCms;
use App\Models\SectionFour;
use App\Models\SectionFive;
use App\Models\SectionThree;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

/**
 * Class FrontRepository
 */
class FrontRepository extends BaseRepository
{
    /**
     * @return void
     */
    public function getFieldsSearchable()
    {
        //
    }

    /**
     * @return string
     */
    public function model()
    {
        return FrontCms::class;
    }

    /**
     * @return array
     */
    public function getFrontScreenData()
    {
        $data = null;
        if (request()->route()->getName() == 'cms.section.one.index') {
            $data['sectionOne'] = FrontCms::toBase()->where('type', FrontCms::SECTION_ONE)->pluck('value', 'key');
            $data['viewName'] = 'front.section_one.index';
        }
        if (request()->route()->getName() == 'cms.section.two.index') {
            $data['sectionTwo'] = FrontCms::toBase()->where('type', FrontCms::SECTION_TWO)->pluck('value', 'key');
            $data['viewName'] = 'front.section_two.index';
        }

        return $data;
    }

    /**
     * @param  array  $input
     *
     * @return array
     */
    public function updateCms($input)
    {
        $cmsInputArray = Arr::except($input, ['_token', '_method']);
        if ($input['section'] == FrontCms::SECTION_ONE) {
            $this->updateSection($cmsInputArray);

            return ['status'   => true, 'message' => 'Section One updated successfully',
                    'redirect' => 'cms.section.one.index',
            ];
        }
        if ($input['section'] == FrontCms::SECTION_TWO) {
            $this->updateSection($cmsInputArray);

            return [
                'status'   => true, 'message' => 'Section Two updated successfully',
                'redirect' => 'cms.section.two.index',
            ];
        }
    }

    /**
     * @param  array  $inputData
     *
     * @return bool
     */
    public function updateSection($inputData)
    {
        foreach ($inputData as $key => $value) {
            $frontCmsSetting = FrontCms::where('key', $key)->first();
            if (! $frontCmsSetting) {
                continue;
            }
            if (in_array($key, ['s2_background_image']) && ! empty($value)) {
                $this->fileUpload($frontCmsSetting, $value);
                continue;
            }
            $frontCmsSetting->update(['value' => $value]);
        }

        return true;
    }

    /**
     * @param $frontCmsSetting
     *
     * @param $file
     *
     * @return mixed
     */
    public function fileUpload($frontCmsSetting, $file)
    {
        if (! empty($frontCmsSetting->getMedia(FrontCms::FRONT_CMS_PATH)->first())) {
            $frontCmsSetting->clearMediaCollection(FrontCms::FRONT_CMS_PATH);
        }
        $media = $frontCmsSetting->addMedia($file)->toMediaCollection(FrontCms::FRONT_CMS_PATH,
            config('app.media_disc'));
        $frontCmsSetting->update(['value' => $media->getUrl()]);

        return $frontCmsSetting;
    }

    /**
     * @param  array  $input
     *
     * @return bool
     */
    public function storeSectionThreeData($input)
    {
        $sectionThree = SectionThree::create(Arr::except($input, ['_token', 'section', 'image_url']));
        $media = $sectionThree->addMedia($input['image_url'])->toMediaCollection(SectionThree::FRONT_CMS_PATH,
            config('app.media_disc'));
        $sectionThree->update(['image_url' => $media->getUrl()]);

        return true;
    }

    /**
     * @param  array  $input
     *
     * @return bool
     */
    public function storeSectionFourData($input)
    {
        $sectionFour = SectionFour::create(Arr::except($input, ['_token', 'section', 'image_url']));
        $media = $sectionFour->addMedia($input['image_url'])->toMediaCollection(SectionFour::FRONT_CMS_PATH,
            config('app.media_disc'));
        $sectionFour->update(['image_url' => $media->getUrl()]);

        return true;
    }
    
    /**
     * @param  array  $input
     *
     * @return bool
     */
    public function storeSectionFiveData(array $input)
    {
        SectionFive::create($input);
        
        return true;
    }
    
    /**
     * @return mixed
     */
    public function getSectionThreeData()
    {
        $data['sectionThreeFront'] = FrontCms::where('type', FrontCms::SECTION_THREE)->pluck('value', 'key')->toArray();

        return $data;
    }
    
    /**
     * @return mixed
     */
    public function getSectionFiveData()
    {
        $data['sectionFiveFront'] = FrontCms::where('type', FrontCms::SECTION_FIVE)->pluck('value', 'key')->toArray();

        return $data;
    }


    /**
     * @return array
     */
    public function getSectionFourData()
    {
        $data['sectionFourFront'] = FrontCms::where('type', FrontCms::SECTION_FOUR)->pluck('value', 'key')->toArray();

        return $data;
    }
    
    /**
     * @param  array  $input
     * @param  SectionThree  $sectionThree
     *
     * @return bool
     */
    public function updateSectionThreeData($input, $sectionThree)
    {
        $frontCmsData = Arr::only($input, ['s3_text_title', 's3_image_main']);
        foreach ($frontCmsData as $key => $value) {
            $frontCmsSetting = FrontCms::where('key', $key)->first();
            if (! $frontCmsSetting) {
                continue;
            }
            if ($key === 's3_image_main' && ! empty($value)) {
                $this->fileUpload($frontCmsSetting, $value);
                continue;
            }
            $frontCmsSetting->update(['value' => $value]);
        }

        $sectionThreeData = Arr::only($input, ['image_text', 'image_text_secondary', 'slider_text']);
        $sectionThree->update($sectionThreeData);
        if (! empty($input['image_url'])) {
            $sectionThree->clearMediaCollection(SectionThree::FRONT_CMS_PATH);
            $media = $sectionThree->addMedia($input['image_url'])->toMediaCollection(SectionThree::FRONT_CMS_PATH,
                config('app.media_disc'));
            $sectionThree->update(['image_url' => $media->getUrl()]);
        }

        return true;
    }

    /**
     * @param  array  $input
     * 
     * @param $sectionFour
     * 
     * @return bool
     */
    public function updateSectionFourData($input, $sectionFour)
    {
        $frontCmsData = Arr::only($input, ['s4_text_title', 's4_text_secondary']);
        
        foreach ($frontCmsData as $key => $value) {
            $frontCmsSetting = FrontCms::where('key', $key)->first();
            
            if (! $frontCmsSetting) {
                continue;
            }
            
            $frontCmsSetting->update(['value' => $value]);
        }

        $sectionFourData = Arr::only($input, ['image_text', 'image_text_description', 'color']);
        $sectionFour->update($sectionFourData);
        
        if (! empty($input['image_url'])) {
            $sectionFour->clearMediaCollection(SectionFour::FRONT_CMS_PATH);
            $media = $sectionFour->addMedia($input['image_url'])->toMediaCollection(SectionFour::FRONT_CMS_PATH,
                config('app.media_disc'));
            $sectionFour->update(['image_url' => $media->getUrl()]);
        }

        return true;
    }
    /**
     * @param  array  $input
     * 
     * @param $sectionFive
     * 
     * @return bool
     */
    public function updateSectionFiveData($input, $sectionFive)
    {
        $frontCmsData = Arr::only($input, ['s5_text_title', 's5_main_image']);
        foreach ($frontCmsData as $key => $value) {
            $frontCmsSetting = FrontCms::where('key', $key)->first();
            if (! $frontCmsSetting) {
                continue;
            }
            if ($key === 's5_main_image' && ! empty($value)) {
                $this->fileUpload($frontCmsSetting, $value);
                continue;
            }
            $frontCmsSetting->update(['value' => $value]);
        }

        $sectionFiveData = Arr::only($input, ['text_main', 'text_secondary']);
        $sectionFive->update($sectionFiveData);

        return true;
    }
    /**
     * @return array
     */
    public function prepareLandingScreenData()
    {
        $frontCms = FrontCms::toBase()->get();
        $data['sectionOne'] = $frontCms->where('type', FrontCms::SECTION_ONE)->pluck('value', 'key');
        $data['sectionTwo'] = $frontCms->where('type', FrontCms::SECTION_TWO)->pluck('value', 'key');

        $data['sectionThreeFrontCms'] = $frontCms->where('type', FrontCms::SECTION_THREE)->pluck('value',
            'key');
        $data['sectionFourFrontCms'] = $frontCms->where('type', FrontCms::SECTION_FOUR)->pluck('value',
            'key');
        $data['sectionFiveFrontCms'] = $frontCms->where('type', FrontCms::SECTION_FIVE)->pluck('value',
            'key');
        $data['sectionFiveData'] = SectionFive::latest()->take(4)->get();
        $data['sectionThreeData'] = SectionThree::toBase()->get();
        $data['sectionFourData'] = SectionFour::latest()->take(6)->get();

        $data['sectionFour'] = $frontCms->where('type', FrontCms::SECTION_FOUR)->pluck('value', 'key');
        $data['sectionFive'] = $frontCms->where('type', FrontCms::SECTION_FIVE)->pluck('value', 'key');
        $data['sectionSix'] = $frontCms->where('type', FrontCms::SECTION_SIX)->pluck('value', 'key');
        $data['adminSetting'] = AdminSetting::toBase()->get();
        $data['generalSettings'] = $data['adminSetting']->where('type', AdminSetting::GENERAL)->pluck('value', 'key');
        $data['socialSettings'] = $data['adminSetting']->where('type', AdminSetting::SOCIAL_SETTING)->pluck('value', 'key');
        

        return $data;
    }

    /**
     * @return array
     */
    public function privacyPolicyAndTermConditionsData()
    {
        $data['generalSettings'] = AdminSetting::toBase()->where('type', AdminSetting::GENERAL)->pluck('value', 'key');
        $data['sectionSix'] = FrontCms::toBase()->where('type', FrontCms::SECTION_SIX)->pluck('value', 'key');
        $data['socialSettings'] = AdminSetting::toBase()->where('type', AdminSetting::SOCIAL_SETTING)->pluck('value',
            'key');

        return $data;
    }

    /**
     * @return array
     */
    public function featuredPortfolioData()
    {
        $data['adminSetting'] = AdminSetting::toBase()->get();
        $data['generalSettings'] = $data['adminSetting']->where('type', AdminSetting::GENERAL)->pluck('value', 'key');
        $data['sectionSix'] = FrontCms::toBase()->where('type', FrontCms::SECTION_SIX)->pluck('value', 'key');
        $data['socialSettings'] = $data['adminSetting']->where('type', AdminSetting::SOCIAL_SETTING)->pluck('value',
            'key');
        $data['featuredPortfoliosCount'] = User::with(['media', 'roles'])
            ->whereNotNull('email_verified_at')->where('is_portfolio_featured', User::FEATURED_PORTFOLIO_YES)
            ->where('status', User::ACTIVE)->whereHas('roles', function ($q) {
                $q->where('name', 'admin');
            })->toBase()->count();

        $data['featuredPortfolios'] = $this->getUserFeaturedPortfolios();

        return $data;
    }

    /**
     * @param  array  $input
     *
     * @return array
     */
    public function showMoreFeaturedPortfolioData($input)
    {
        $count = $input['currentFeaturedCount'];
        $data['featuredPortfolios'] = $this->getUserFeaturedPortfolios($count);

        return $data;
    }

    /**
     * @param  int  $skipCount
     *
     * @return Builder[]|Collection
     */
    public function getUserFeaturedPortfolios($skipCount = 0)
    {
        $portfolios = User::with(['media'])
            ->whereNotNull('email_verified_at')->where('is_portfolio_featured', User::FEATURED_PORTFOLIO_YES)
            ->where('status', User::ACTIVE)->whereHas('roles', function ($q) {
                $q->where('name', 'admin');
            })->skip($skipCount)->take(6)->get();

        return $portfolios;
    }


    /**
     * @return array
     */
    public function getSubscriptionPlansData(): array
    {
        $data = null;
        $data['generalSettings'] = AdminSetting::toBase()->where('type', AdminSetting::GENERAL)->pluck('value', 'key');
        $data['sectionSix'] = FrontCms::toBase()->where('type', FrontCms::SECTION_SIX)->pluck('value', 'key');
        $data['socialSettings'] = AdminSetting::toBase()->where('type', AdminSetting::SOCIAL_SETTING)->pluck('value',
            'key');
        $data['subscriptionPricingMonthPlans'] = SubscriptionPlan::with(['currency', 'plan'])->where('plan_type', '=',
            '1')->get();
        $data['subscriptionPricingYearPlans'] = SubscriptionPlan::with(['currency', 'plan'])->where('plan_type', '=',
            '2')->get();

        return $data;
    }

    /**
     * @param $id
     * @return array
     */
    public function paymentMethodData($id)
    {
        $data = null;
        $data['generalSettings'] = AdminSetting::toBase()->where('type', AdminSetting::GENERAL)->pluck('value', 'key');
        $data['sectionSix'] = FrontCms::toBase()->where('type', FrontCms::SECTION_SIX)->pluck('value', 'key');
        $data['socialSettings'] = AdminSetting::toBase()->where('type', AdminSetting::SOCIAL_SETTING)->pluck('value',
            'key');
        $data['subscriptionPricingPlan'] = SubscriptionPlan::findorfail($id);

        return $data;
    }

    /**
     * @param $input
     * @return bool
     */
    public function storeFollowPortfolio($input)
    {
        $followerId = $input['id'];
        $followingId = getLoggedInUserId();
        $favouritePortfolio = FavoritePortfolio::where('follower_id', $input['id'])
            ->where('following_id', getLoggedInUserId())
            ->exists();
        if (! $favouritePortfolio) {
            FavoritePortfolio::create([
                'follower_id'  => $followerId,
                'following_id' => $followingId,
            ]);

            return true;
        }

        FavoritePortfolio::where('follower_id', $input['id'])
            ->where('following_id', getLoggedInUserId())
            ->delete();

        return false;
    }
}
