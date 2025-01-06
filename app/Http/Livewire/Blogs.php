<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Blogs extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $searchByBlog = '';
    public $categoryFilter = '';
    public $status = '';

    protected $listeners = ['filterCategory', 'isPublished', 'isFeatured', 'refresh' => '$refresh', 'statusFilter'];

    /**
     * @return string
     */
    public function paginationView()
    {
        return 'livewire.custom-pagination';
    }

    public function nextPage($lastPage)
    {
        if ($this->page < $lastPage) {
            $this->page = $this->page + 1;
        }
    }

    public function previousPage()
    {
        if ($this->page > 1) {
            $this->page = $this->page - 1;
        }
    }

    public function updatingsearchByBlog()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $blogs = $this->searBlogs();

        return view('livewire.blogs', compact('blogs'));
    }

    public function searBlogs()
    {
        $query = Blog::with(['category', 'media'])->where('tenant_id', getLoggedInUser()->tenant_id);

        $query->when(! empty($this->categoryFilter), function (Builder $q) {
            $q->WhereHas('category', function (Builder $q) {
                $q->where('id', $this->categoryFilter);
            });
        }); 
        
        $query->when($this->status != '', function (Builder $q) {
                $q->where('is_published', $this->status);
        });

        $query->when($this->searchByBlog != '', function (Builder $query) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%'.strtolower($this->searchByBlog).'%');
                $q->orWhereHas('category', function (Builder $q) {
                    $q->where('name', 'like', '%'.strtolower($this->searchByBlog).'%');
                });
            });
        });

        $all = $query->paginate(8);
        $currentPage = $all->currentPage();
        $lastPage = $all->lastPage();
        if ($currentPage > $lastPage) {
            $this->page = $lastPage;
        }

        return $query->paginate(8);
    }

    /**
     * @param $category
     */
    public function filterCategory($category)
    {
        $this->categoryFilter = $category;
        $this->resetPage();
    }

    /**
     * @param $status
     */
    public function statusFilter($status)
    {
        $this->status = $status;
        $this->resetPage();
    }
    
    /**
     * @param $id
     */
    public function isPublished($id)
    {
        $blog = Blog::find($id);
        $isPublished = $blog->is_published;
        $blog->update([
            'is_published' => !$isPublished,
        ]);
    }

    /**
     * @param $id
     */
    public function isFeatured($id)
    {
        $blog = Blog::find($id);
        $isFeatured = $blog->is_featured;
        $blog->update([
           'is_featured' => !$isFeatured,
        ]);
    }
}
