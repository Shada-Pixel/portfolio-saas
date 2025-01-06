<?php

namespace App\Repositories;

use App\Models\RecentWork;
use Illuminate\Support\Arr;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class RecentWorkRepository
 */
class RecentWorkRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'type',
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
        return RecentWork::class;
    }

    /**
     * @param $input
     */
    public function store($input)
    {
        try {
            /** @var RecentWork $recentWork */
            $recentWork = RecentWork::create($input);
            $attachmentsInput = Arr::only($input, ['attachments']);

            if (! empty($attachmentsInput)) {
                foreach ($attachmentsInput['attachments'] as $attachment) {
                    $recentWork->addMedia($attachment)->toMediaCollection(RecentWork::ATTACHMENT,
                        config('app.media_disc'));
                }
            }

        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $input
     *
     * @param $recentWork
     *
     */
    public function updateRecord($input, $recentWork)
    {
        try {
            $attachmentsInput = Arr::only($input, ['attachments']);

            /** @var RecentWork $recentWork */
            $recentWork->update($input);

            if (! empty($attachmentsInput)) {
                foreach ($attachmentsInput['attachments'] as $attachment) {
                    $recentWork->addMedia($attachment)->toMediaCollection(RecentWork::ATTACHMENT,
                        config('app.media_disc'));
                }
            }

            $recentWork->save();

        } catch (\Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
