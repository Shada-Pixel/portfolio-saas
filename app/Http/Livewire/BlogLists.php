<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use App\Models\MultiTenant;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class BlogLists extends Component
{
    use WithPagination;
   
    public $searchBlogList = '';
    public $category = null;

    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh' => '$refresh', 'searchBlogs'];
    
    /**
     * @return Application|Factory|View
     */
    public function render()
    {   
        $blogs = $this->searchBlogsList();

        return view('livewire.blog-lists', compact('blogs'));
    }

    /**
     * @return LengthAwarePaginator
     */
    public function searchBlogsList()
    {
        $user = MultiTenant::where('tenant_username', session('tenant_user_name'))->get();
        $query = Blog::with(['category', 'media'])->where('is_published', '=', Blog::PUBLISHED)->where('tenant_id', '=',
            $user[0]->id);
        $query->when($this->searchBlogList != '', function (Builder $q) {
            $q->where(function (Builder $q) {
                $q->orWhere('title', 'like', '%'.strtolower($this->searchBlogList).'%')
                    ->orWhere('description', 'like', '%'.strtolower($this->searchBlogList).'%');
            });
        });

        $query->when($this->searchBlogList == '', function (Builder $q) {
            $q->where('is_featured', Blog::FEATURED);
        });
        
        if ($this->searchBlogList == null && $this->category != null) {
            $query->where('category_id', $this->category->id);
        }
        
        return $query->paginate(6);
    }

    /**
     * @param $blogs
     */
    public function searchBlogs($blogs)
    {
        $this->searchBlogList = $blogs;
        $this->resetPage();
    }
}
