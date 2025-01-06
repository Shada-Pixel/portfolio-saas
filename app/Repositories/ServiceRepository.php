<?php

namespace App\Repositories;

use App\Models\Service;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class ServiceRepository
 */
class ServiceRepository extends BaseRepository
{
    /**
     * @var string[]
     */
    protected $fieldSearchable = [
        'name',
        'description',
    ];
    
    /**
     * @return array|string[]
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * @return string
     */
    public function model()
    {
        return Service::class;
    }

    /**
     * @param $input
     *
     * @return bool
     */
    public function store($input)
    {
        try {
            DB::beginTransaction();
            
            $service = Service::create($input);

            if (isset($input['icon']) && ! empty($input['icon'])) {
                $service->addMedia($input['icon'])->toMediaCollection(Service::ICON, config('app.media_disc'));
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
     * @param $id
     *
     * @return bool
     */
    public function update($input, $id)
    {
        $service = Service::findOrfail($id);
        try {
            
            if (isset($input['icon']) && ! empty($input['icon'])) {
                $service->clearMediaCollection(Service::ICON);
                $service->addMedia($input['icon'])->toMediaCollection(Service::ICON, config('app.media_disc'));
            }
            $service->update($input);

        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }

        return true;
    }
}
