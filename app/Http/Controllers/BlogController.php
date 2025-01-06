<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Setting;
use App\Repositories\BlogRepository;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laracasts\Flash\Flash;

class BlogController extends AppBaseController
{

    /**
     * @var BlogRepository
     */
    private $blogRepo;

    /**
     * BlogController constructor.
     *
     * @param  BlogRepository  $blogRepository
     */
    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepo = $blogRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->pluck('name', 'id');
        $status = Blog::STATUS;

        return view('blogs.index', compact('categories', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $category = Category::toBase()->pluck('name', 'id');

        return view('blogs.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateBlogRequest  $request
     *
     * @return RedirectResponse
     */
    public function store(CreateBlogRequest $request)
    {
        $input = $request->all();
        try {
            $input['is_featured'] = isset($input['is_featured']) ? 1 : 0;
            $this->blogRepo->store($input);

            Flash::success('Post created successfully.');

            return redirect()->route('blogs.index');
        } catch (Exception $e) {
            return redirect()->back()->withInput($input)->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Application|Factory|View
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id);

        return view('blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $category = Category::toBase()->pluck('name', 'id');

        return view('blogs.edit', compact('category', 'blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateBlogRequest  $request
     *
     * @param  int  $id
     *
     * @return RedirectResponse
     */
    public function update(UpdateBlogRequest $request, $id)
    {
        $input = $request->all();
        $blog = Blog::findOrFail($id);
        $input['is_featured'] = isset($input['is_featured']) ? 1 : 0;
        $this->blogRepo->update($input, $blog->id);

        Flash::success('Post updated successfully.');

        return redirect()->route('blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return $this->sendSuccess('Post deleted successfully.');
    }

    /**
     * @param $username
     * @param $slug
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function blogDetails($username, $slug)
    {
        $blogExists = Blog::whereSlug($slug)->exists();
        if (! $blogExists) {
            return redirect()->back();
        }

        $categories = Category::with('blogs')->has('blogs', '>', 1)
            ->whereHas('blogs', function (Builder $query) {
                $query->where('is_published', Blog::PUBLISHED);
            })->orderByDesc('created_at')->take(4)->get();

        $blog = Blog::with(['category', 'media'])->where('slug', $slug)->first();
        $prevBlog = Blog::whereIsPublished(Blog::PUBLISHED)->where('id', '<', $blog->id)->orderBy('id',
            'desc')->take(1)->first();
        $nexBlog = Blog::whereIsPublished(Blog::PUBLISHED)->where('id', '>',
            $blog->id)->orderBy('id')->take(1)->first();

        $user = getUser();
        $themeLayout = getSettingValue('theme_layout');
        if ($themeLayout == Setting::TEMPLATE_ONE) {
            return \view('web.blogs.blog_details', compact('blog', 'prevBlog', 'nexBlog', 'categories','user'));
        } elseif ($themeLayout == Setting::TEMPLATE_TWO) {
            return \view('web.new_blogs.new_blog_details', compact('blog', 'prevBlog', 'nexBlog', 'categories','user'));
        } elseif ($themeLayout == Setting::TEMPLATE_THREE) {
            return \view('web.new_theme_three.blogs.blog_details',
                compact('blog', 'prevBlog', 'nexBlog', 'categories','user'));
        } else {
            return \view('web.blogs.blog_details', compact('blog', 'prevBlog', 'nexBlog', 'categories','user'));
        }
    }

    /**
     * @return Application|Factory|View
     */
    public function getBlogLists()
    {
        $user = getUser();
        $data = $this->blogRepo->getBlogListData(null);

        $themeLayout = getSettingValue('theme_layout');
        if ($themeLayout == Setting::TEMPLATE_ONE) {
            return \view('web.blogs.blog_lists', compact('user', 'data'));
        } else {
            if ($themeLayout == Setting::TEMPLATE_TWO) {
                return \view('web.new_blogs.new_blog_lists', compact('user', 'data'));
            } elseif ($themeLayout == Setting::TEMPLATE_THREE) {
                return \view('web.new_theme_three.blogs.blog_lists', compact('user', 'data'));
            } else {
                return \view('web.blogs.blog_lists', compact('user', 'data'));
            }
        }
    }

    /**
     * @param $username
     * @param $slug
     *
     * @return Application|Factory|View|RedirectResponse
     */
    public function getCategoryBlogs($username, $slug)
    {
        $category = Category::withCount('blogs')->whereHas('blogs', function (Builder $query) {
            $query->where('is_published', Blog::PUBLISHED);
        })->where('slug', '=', $slug)->first();
        if (! $category) {
            return redirect()->back();
        }

        $blogs = Blog::with('category', 'media')->where('category_id', $category->id)->where('is_featured',
            Blog::FEATURED)->orWhere('is_published', Blog::PUBLISHED)->paginate(6);
        $data = $this->blogRepo->getBlogListData($slug);

        $user = getUser();
        $themeLayout = getSettingValue('theme_layout');
        if ($themeLayout == Setting::TEMPLATE_ONE) {
            return \view('web.blogs.blog_lists', compact('blogs', 'category', 'user', 'data'));
        } elseif ($themeLayout == Setting::TEMPLATE_TWO) {
            return \view('web.new_blogs.new_blog_lists', compact('blogs', 'category', 'user', 'data'));
        } elseif ($themeLayout == Setting::TEMPLATE_THREE) {
            return \view('web.new_theme_three.blogs.blog_lists', compact('blogs', 'category', 'user', 'data'));
        } else {
            return \view('web.blogs.blog_lists', compact('blogs', 'category', 'user', 'data'));
        }
    }

    /**
     * @param  Request  $request
     *
     * @return Application|Factory|View
     */
    public function searchBlog(Request $request)
    {
        $input = $request->all();
        $blog = Blog::query();
//        
//        if ($request->ajax()) {
//            if (isset($input['search'])) {
//                $query = $blog->with(['category', 'media']);
//                $query->where(function (Builder $query) use ($input) {
//                    $query->where('title', 'like', '%'.strtolower($input['search']).'%')
//                        ->orWhere('description', 'like', '%'.strtolower($input['search']).'%');
//                })->where('is_published', '=', Blog::PUBLISHED);
//                $blogs = $query->paginate(6);
//                
//                return $this->sendResponse($blogs, 'Search blog retrieved Successfully');
//            } else {
//                $blogs = $blog->with(['category', 'media'])->where('is_featured', Blog::FEATURED)->where('is_published',
//                    Blog::PUBLISHED)->paginate(6);
//
//                return $this->sendResponse($blogs, 'Search blog retrieved Successfully');
//            }
//        }

        $blogs = $blog->with(['category', 'media'])->where('is_featured', Blog::FEATURED)->orWhere('is_published',
            Blog::PUBLISHED)->paginate(6);

        $data['topBlogs'] = Blog::with('category', 'media')->where('is_published',
            Blog::PUBLISHED)->where('is_featured', Blog::FEATURED)->inRandomOrder()->take(5)->get();
        $data['categories'] = Category::with('blogs')->withCount('blogs')
            ->whereHas('blogs', function (Builder $query) {
                $query->where('is_published', Blog::PUBLISHED);
            })->orderByDesc('blogs_count')->take(6)->get();

        return \view('web.blogs.blog_lists', compact('blogs'))->with($data);

    }
}
