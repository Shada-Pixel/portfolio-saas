<div>
    <div class="mt-0 mb-3 col-12 d-flex justify-content-end">
        <div class="pr-0 pl-2 pt-2 pb-2 mb-3 mr-3">
            <input wire:model.debounce.100ms="searchByBlog" type="search"
                   class="form-control form-control-sm search-box" placeholder="{{__('messages.search')}}"
                   id="searchByBlog">
        </div>
    </div>
    <div class="row">
    @forelse($blogs as $blog)
        
        <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-3 mb-3 custom-blog-card">
            <article class="article mb-0 h-100">
                <div class="article-header">
                    <div class="article-image">
                        <img alt="" src="{{  !empty($blog->image_url) ? $blog->image_url : asset('assets/img/article-image.png') }}">
                    </div>
                    <div class="article-title">
                        <h2><a href="{{ route('blogs.show', $blog->id) }}">{{ $blog->title }}</a></h2>
                    </div>
                </div>
                <div class="article-details">
                    <div class="article-cta d-flex justify-content-between">
                        <div class="d-flex flex-column align-items-center">
                            <div class="status mr-2">
                                @if($blog->is_featured)
                                    <h6>
                                        <span class="badge badge-success">{{__('messages.blogs_category.featured')}}</span>
                                    </h6>
                                @else
                                    <h6>
                                        <span class="badge badge-danger">{{__('messages.blogs_category.not_featured')}}</span>
                                    </h6>
                                @endif
                            </div>
                            <label class="custom-toggle pl-0 mt-2">
                                <input type="checkbox" name="is_featured" class="is-featured" data-id="{{ $blog->id }}" {{ $blog->is_featured ? 'checked' : '' }}>
                                <span class="custom-toggle-slider rounded-circle ml-auto"></span>
                            </label>
                        </div>
                        <div class="d-flex align-items-center no-touch">
                            <nav class="cd-stretchy-nav edit-content">
                                <a class="cd-nav-trigger" href="#0">

                                    <span aria-hidden="true"></span>
                                </a>

                                <ul>
                                    <li><a href="{{ route('blogs.edit', $blog->id) }}" class="edit-btn text-white">
                                            <span>{{__('messages.edit')}}</span>
                                            <i class="fas fa-pen"></i>
                                        </a></li>
                                    <li><a href="javascript:void(0)" class="delete-btn text-white" data-id="{{ $blog->id }}">
                                            <span>{{__('messages.blogs_category.delete')}}</span>
                                            <i class="fas fa-trash"></i>
                                        </a></li>
                                </ul>

                                <span aria-hidden="true" class="stretchy-nav-bg"></span>
                            </nav>
                            
                            <div class="d-flex flex-column align-items-center pl-2">
                                <div class="status mr-2">
                                    @if($blog->is_published)
                                        <h6>
                                            <span class="badge badge-success">{{__('messages.blogs_category.published')}}</span>
                                        </h6>
                                    @else
                                        <h6>
                                            <span class="badge badge-info">{{__('messages.blogs_category.draft')}}</span>
                                        </h6>
                                    @endif
                                </div>
                                <label class="custom-toggle pl-0 mt-2">
                                    <input type="checkbox" name="is_published" class="is-published" data-id="{{ $blog->id }}" {{ $blog->is_published ? 'checked' : '' }}>
                                    <span class="custom-toggle-slider rounded-circle"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    @empty
        <div class="col-lg-12 col-md-12 d-flex justify-content-center">
            @if($searchByBlog == null || empty($searchByBlog))
                <h1 class="font-size">{{ __('messages.blogs_category.no_post_available') }}</h1>
            @else
                <h1 class="font-size">{{ __('messages.blogs_category.no_post_found') }}</h1>
            @endif
        </div>
    @endforelse
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-end blog-pagination-link">
        @if($blogs->count() > 0)
            {{ $blogs->links() }}
        @endif
    </div>
</div>
