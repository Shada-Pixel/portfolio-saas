<?php

namespace App\Repositories;

use App\Models\PlanAttribute;
use App\Models\PricingPlan;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Validator;

/**
 * Class PricingPlanRepository
 * @package App\Repositories
 * @version April 28, 2020, 11:09 am UTC
 */
class PricingPlanRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return PricingPlan::class;
    }

    /**
     * @param $input
     *
     * @return bool
     */
    public function store($input)
    {
        $planAttributeInputArray = Arr::only($input, ['attribute_name', 'attribute_icon']);

        try {
            DB::beginTransaction();

            /** @var PricingPlan $pricingPlan */
            $pricingPlan = PricingPlan::create(Arr::only($input, ['name', 'type', 'color', 'price', 'plan_type', 'currency_id']));

            self::createPlanAttributes($planAttributeInputArray, $pricingPlan);

            if (isset($input['icon']) && ! empty($input['icon'])) {
                $media = $pricingPlan->addMedia($input['icon'])->toMediaCollection(PricingPlan::ICON,
                    config('app.media_disc'));
                $pricingPlan->update(['media_id' => $media->id]);
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
     * @return array
     */
    public function preparePlanAttributeInput($input)
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
     * @param $planAttributeInputArray
     * 
     * @param $pricingPlan
     */
    public function createPlanAttributes($planAttributeInputArray, $pricingPlan)
    {
        try {
            DB::beginTransaction();

            $planAttributeInput = $this->preparePlanAttributeInput($planAttributeInputArray);
            foreach ($planAttributeInput as $key => $data) {
                $validator = Validator::make($data, PlanAttribute::$rules);

                if ($validator->fails()) {
                    throw new UnprocessableEntityHttpException($validator->errors()->first());
                }

                /** @var PlanAttribute $planAttribute */
                $data['pricing_plan_id'] = $pricingPlan->id;
                PlanAttribute::create($data);
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
     * @param $pricingPlan
     * 
     * @return bool
     */
    public function editRecord($input, $pricingPlan)
    {
        $planAttributeInputArray = Arr::only($input, ['attribute_name', 'attribute_icon']);

        try {
            DB::beginTransaction();

            /** @var PricingPlan $pricingPlan */
            $pricingPlan = PricingPlan::find($pricingPlan->id);
            $pricingPlan->update(Arr::only($input, ['name', 'type', 'color', 'price', 'plan_type', 'currency_id']));

            $pricingPlan->planAttributes()->delete();
            self::createPlanAttributes($planAttributeInputArray, $pricingPlan);

            if (isset($input['icon']) && ! empty($input['icon'])) {
                $pricingPlan->clearMediaCollection(PricingPlan::ICON);
                $media = $pricingPlan->addMedia($input['icon'])->toMediaCollection(PricingPlan::ICON,
                    config('app.media_disc'));
                $pricingPlan->update(['media_id' => $media->id]);
            }

            DB::commit();

            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
