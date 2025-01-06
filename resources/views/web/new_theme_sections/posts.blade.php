@if($blogs->count() > 0)
    <div class="latest-post_section py-5 active-header" id="latestPost">
        <div class="post-heading text-center mb-5">
            <h1 class="mb-2">Latest Posts</h1>
        </div>
        <div class="container d-flex justify-content-center align-items-center">
            <div class="row w-75 d-flex justify-content-center">
                @foreach($blogs as $blog)
                    <div class="col-lg-4 col-sm-8">
                        <div class="card post-card mb-lg-0 mb-5 h-100">
                            <div class="blogpost-image position-relative overflow-hidden">
                                <a href="{{route('blog.details',[$user->user_name, $blog->slug])}}">
                                    <img src="{{$blog->image_url}}" alt="award-icon" class="img-fluid blog_post_image"/>
                                </a>
                            </div>
                            <div class="card-body">
                                <h3 class="blogpost-short-detail__blogpost-title">
                                    <a href="{{route('blog.details',[$user->user_name, $blog->slug])}}"
                                       class="text-decoration-none text-dark custom_blog_a_tag">{{$blog->title}}</a>
                                </h3>
                                <h6 class="card-title">{{$blog->created_at->format('d M, Y')}}</h6>
                                <p class="card-text">
                                    {{strip_tags(Str::limit($blog->description, 100, '...')) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @if(count($blogs) >= 3)
            <div class="text-center mt-5">
                <a class="btn post-btn px-5" href="{{route('blog.lists', $user->user_name)}}">View All</a>
            </div>
        @endif
    </div>
@endif
