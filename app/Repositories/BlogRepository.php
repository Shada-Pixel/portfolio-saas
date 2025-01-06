<?php

namespace App\Repositories;

use App\Models\Blog;
use App\Models\Category;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class BlogRepository
 */
class BlogRepository extends BaseRepository
{
    private $filedSearchable = [
        'title',
        'description',
    ];

    public function getFieldsSearchable()
    {
        return $this->filedSearchable;
    }

    public function model()
    {
        return Blog::class;
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
            $blog = Blog::create($input);
            if (isset($input['image']) && ! empty($input['image'])) {
                $media = $blog->addMedia($input['image'])->toMediaCollection(Blog::PATH, config('app.media_disc'));

                $blog->update(['media_id' => $media->id]);
            }

            DB::commit();

            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     *
     * @param $id
     * 
     * @return Builder|Builder[]|Collection|Model|void
     */
    public function update($input, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update($input);

        if (isset($input['image']) && ! empty($input['image'])) {
            $blog->clearMediaCollection(Blog::PATH);
            $blog->addMedia($input['image'])->toMediaCollection(Blog::PATH,
                config('app.media_disc'));
        }
    }

    /**
     * @return mixed
     */
    public function getBlogListData($slug)
    {
        if ($slug == null && empty($slug)) {
            $data['blogs'] = Blog::with('category', 'media')->where('is_published', Blog::PUBLISHED)->orWhere('is_featured', Blog::FEATURED)->paginate(6);
        }
        
        $data['topBlogs'] = Blog::with('category', 'media')->where('is_featured', Blog::FEATURED)->where('is_published', Blog::PUBLISHED)->inRandomOrder()->take(5)->get();
        $data['categories'] = Category::with('blogs')->withCount('blogs')->whereHas('blogs', function (Builder $query){
            $query->where('is_published', Blog::PUBLISHED);
        })->orderByDesc('blogs_count')->take(6)->get();

        return $data;
    }
}
