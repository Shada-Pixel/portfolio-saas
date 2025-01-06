<!-- lattest post section starts  -->

@if(count($blogs) > 0)
    <section class="latest-post padding-top-100 padding-top-md-50 custom-padding-top-15" id="latest-post">
        <div class="first-content text-center">
            <h2 class="first-content__heading position-relative text-uppercase mb-5 custom_heading_tag custom-mb-2"
                data-aos="fade-up"
                data-aos-once="true">
                Latest Posts
            </h2>
        </div>
        <div class="container">
            <div class="latest-post__block">
                <div class="row">
                    @foreach($blogs as $blog)
                        <div class="col-lg-12 blog-card mb-xl-0 mb-4">
                            <div class="row no-gutters align-items-start">
                                <div class="col-xl-6">
                                    <div class="blogpost-image position-relative overflow-hidden">
                                        <a href="{{route('blog.details',[$user->user_name, $blog->slug])}}">
                                            <img data-src="{{$blog->image_url}}" alt="award-icon" class="img-fluid lazy"
                                                 height="546px"/>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="blogpost-short-detail bg-white">
                                        <h3 class="blogpost-short-detail__blogpost-title">
                                            <a href="{{route('blog.details',[$user->user_name, $blog->slug])}}"
                                               class="text-decoration-none text-dark-blue custom_blog_a_tag">{{$blog->title}}</a>
                                        </h3>
                                        <div class="blogpost-short-detail__text">
                                            {!! $blog->description  !!}
                                        </div>
                                        <span class="btn-primary rounded-0 blogpost-short-detail__graphics-btn px-3 mr-4 p-2">{{$blog->category->name}}
                                        </span>
                                        <span
                                                class="blogpost-short-detail__text-mute">{{$blog->created_at->diffForHumans()}}</span>
                                        <a class="btn blogpost-short-detail__read-more-btn d-block text-left mt-3 pl-0"
                                           href="{{route('blog.details',[$user->user_name, $blog->slug])}}">
                                            Read More
                                            <i class="fas fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @if($blog->count() > 3)
                    <div class="col-12 text-center mt-4 custom-mt-0 custom-mt-0-all">
                        <a href="{{route('blog.lists', $user->user_name)}}" class="btn show-more-link">All
                            Posts</a>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endif
