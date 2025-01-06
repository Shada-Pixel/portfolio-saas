@if($blogs->count() > 0)
    {{--Latest Post--}}
    <div class="latest-post_section pt-sm-5 pt-4 pb-5 active-link-class" id="latestPost" data-midnight="white">
        <div class="post-heading text-center mb-5">
            <h1 class="mb-2 text-white">Latest Posts</h1>
        </div>
        <div class="container d-flex justify-content-center align-items-center">
            <div class="row w-100 g-3 justify-content-center">
                @foreach($blogs as $blog)
                    <div class="col-xl-4 col-lg-6">
                        <div class="card post-card mb-lg-0 mb-5 border-0">
                            <a href="{{route('blog.details',[$user->user_name, $blog->slug])}}">
                                <img src="{{$blog->image_url}}" class="img-fluid blog_post_image"/>
                            </a>
                            <div class="card-body">
                                <div class="post-contents">
                                    <h3>
                                        <a href="{{route('blog.details',[$user->user_name, $blog->slug])}}"
                                           class="text-decoration-none text-dark custom_blog_a_tag">{{$blog->title}}</a>
                                    </h3>
                                    <div class="d-flex justify-content-between">
                                        <span>{{$blog->created_at->format('d M, Y')}}</span>
                                    </div>
                                    <p class="post-words">
                                        {{strip_tags(Str::limit($blog->description, 100, '...')) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @if(count($blogs) >= 3)
            <div class="text-center mt-5">
                <a class="btn post-btn px-5" href="{{route('blog.lists',  $user->user_name)}}">View All</a>
            </div>
        @endif
    </div>
@endif
