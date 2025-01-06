<?php

namespace App\Repositories;

use App\Models\Achievement;
use App\Models\Blog;
use App\Models\Education;
use App\Models\Experience;
use App\Models\PricingPlan;
use App\Models\RecentWorkType;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\VCard;
use App\Models\VCardAttribute;
use Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Validator;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class VCardRepository
 */
class VCardRepository extends BaseRepository
{
    /**
     * @var string[]
     */
    private $fieldSearchable = [
        'v_card_name',
        'name',
        'occupation',
        'introduction',
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
        return VCard::class;
    }

    /**
     * @param $input
     *
     * @return bool
     */
    public function store($input)
    {
        $vCardAttributeInputArray = Arr::only($input, ['icon', 'icon_color', 'label_text', 'value_text']);
        try {
            DB::beginTransaction();
            $input['v_card_unique_id'] = VCard::generateUniqueVCardUniqueId();
            /** @var VCard $VCard */
            $vCard = VCard::create(Arr::only($input,
                ['v_card_unique_id', 'template_id', 'v_card_name', 'name', 'occupation', 'introduction']));

            self::createVCardAttributes($vCardAttributeInputArray, $vCard);

            if (isset($input['profile_image']) && ! empty($input['profile_image'])) {
                $vCard->clearMediaCollection(VCARD::PROFILE);
                $vCard->addMedia($input['profile_image'])->toMediaCollection(VCARD::PROFILE,
                    config('app.media_disc'));
            }

            if (isset($input['cover_image']) && ! empty($input['cover_image'])) {
                $vCard->addMedia($input['cover_image'])->toMediaCollection(VCARD::COVER_IMAGE,
                    config('app.media_disc'));
            }

            DB::commit();

            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }

    }

    /**
     * @param $vCardAttributeInputArray
     * @param $vCard
     *
     * @return bool
     */
    public function createVCardAttributes($vCardAttributeInputArray, $vCard)
    {
        try {
            DB::beginTransaction();

            $vCardAttributeInput = $this->prepareVCardAttributeInput($vCardAttributeInputArray);
            foreach ($vCardAttributeInput as $key => $data) {
                if (! empty($data['label_text']) && ! empty($data['value_text'])) {
                    /** @var VCardAttribute $VCardAttribute */
                    $data['v_card_id'] = $vCard->id;
                    VCardAttribute::create($data);
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
     * @param $input
     *
     * @return array
     */
    public function prepareVCardAttributeInput($input)
    {
        $item = [];
        foreach ($input as $key => $data) {
            foreach ($data as $index => $value) {
                $item[$index][$key] = $value;
            }
        }

        return $item;
    }

    /**
     * @param $input
     * @param $VCard
     *
     * @return bool
     */
    public function editRecord($input, $VCard)
    {
        $vCardAttributeInputArray = Arr::only($input, ['icon', 'icon_color', 'label_text', 'value_text']);

        try {
            DB::beginTransaction();

            /** @var VCard $VCard */
            $VCard = VCard::find($VCard->id);
            $VCard->update(Arr::only($input, ['template_id', 'v_card_name', 'name', 'occupation', 'introduction']));

            $data = $VCard->vCardAttributes()->delete();
            self::createVCardAttributes($vCardAttributeInputArray, $VCard);

            if (isset($input['profile_image']) && ! empty($input['profile_image'])) {
                $VCard->clearMediaCollection(VCARD::PROFILE);
                $media = $VCard->addMedia($input['profile_image'])->toMediaCollection(VCARD::PROFILE,
                    config('app.media_disc'));
            }

            if (isset($input['cover_image']) && ! empty($input['cover_image'])) {
                $VCard->clearMediaCollection(VCard::COVER_IMAGE);
                $media = $VCard->addMedia($input['cover_image'])->toMediaCollection(VCard::COVER_IMAGE,
                    config('app.media_disc'));
            }

            DB::commit();

            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }


    /**
     * @return mixed
     */
    public function getHomePageData($vcard)
    {
        $data['services'] = Service::where('tenant_id', $vcard->tenant_id)->orderBy('created_at', 'DESC')->get();
        $data['testimonials'] = Testimonial::where('tenant_id', $vcard->tenant_id)->orderBy('created_at',
            'DESC')->get();
        $data['socialSettings'] = Setting::toBase()->where('tenant_id', $vcard->tenant_id)->where('type',
            Setting::SOCIAL_SETTING)->get();
        $data['user'] = User::with('media')->where('tenant_id', $vcard->tenant_id)->first();

        return $data;
    }
}
