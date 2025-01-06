<div>
    <div class="row justify-content-center blog-card-list">
        @forelse($blogs as $blog)
            <div class="col-xl-6 col-lg-12 col-md-6 blog-page__mini-blog-card ">
                <div class="card border-0">
                    <div class="blog-page__blog-post-img position-relative overflow-hidden">
                        <img data-src="{{$blog->image_url}}" alt="post" class="card-img-top lazy"
                             width="742px"
                             height="546px"/>
                    </div>
                    <div class="card-body">
                        <span class="blog-page__text-inline">
                            <a class="blog-page__tag-name pr-1"
                               href="{{route('blog.details',[getUser()->user_name, $blog->slug])}}">
                                {{$blog->category->name}}
                            </a>
                            - {{ \Carbon\Carbon::parse($blog->created_at)->format('d M Y') }}
                        </span>
                        <a href="{{route('blog.details',[getUser()->user_name, $blog->slug])}}"
                           class="card-title d-block blog-page__blog-name my-2 text-decoration-none">
                            {{$blog->title}}
                        </a>
                        <p class="card-text blog-page__short-description">
                            {!!  strip_tags(\Illuminate\Support\Str::limit($blog->description, 200,'...'))  !!}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            @if($searchBlogList == '' || empty($searchBlogList))
                <h4 class="text-center dark-text custom-empty-message no-blog-found">No Blog Available</h4>
            @else
                <h4 class="text-center dark-text custom-empty-message no-blog-found">No Blog Found</h4>
            @endif
        @endforelse
        <div class="col-lg-12 col-md-12 col-sm-12 d-flex justify-content-center blog-pagination-link">
            @if($blogs->count() > 0)
                {{ $blogs->links() }}
            @endif
        </div>
    </div>
</div>
