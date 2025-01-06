@extends('layouts.web.app')
@section('title')
    Blog Details
@endsection
@section('page_css')

@endsection

@section('content')
    <section class="blog-detail-page padding-top-100 padding-top-lg-30 padding-top-md-50">
        <div class="container">
            <div class="blog-detail-page__block">
                <div class="text-center custom_back_btn_blog">
            <span class="blog-detail-page__category-name position-relative">
              <span class="text-danger pr-1"><a
                          href="{{route('category.blogs',[$user->user_name, $blog->category->slug])}}">{{$blog->category->name}}</a></span>
              Published {{\Carbon\Carbon::parse($blog->created_at)->format('F d, Y')}}
                <div class="position-relative back-button-front d-flex justify-content-end"><a
                            href="{{ url('p/'.$user->user_name) }}"
                            class="btn btn-primary text-center">Back</a></div>
            </span>
                    <h1 class="mt-3 blog-detail-page__main-blog-title" data-aos="fade-up"
                        data-aos-once="true">{{$blog->title}}</h1>
                    {{--                    <p class="blog-detail-page__sub-text" data-aos="fade-up" data-aos-once="true">Why Branding matters--}}
                    {{--                        to your Business</p>--}}
                </div>
                <div class="blog-detail-page__content">
                    <div class="blog-detail-page__first-image position-relative overflow-hidden">
                        <img data-src="{{$blog->image_url}}" alt="post" class="img-fluid lazy"
                             width="446" height="335">
                    </div>
                    <div class="blog-detail-page__description bg-white mt-4 mt-md-0">
                        <span class="blog-detail-page__paragraphs mb-4">
                            {!!  html_entity_decode($blog->description)  !!}
                        </span>
                        <div class="nav blog-pagination justify-content-between">
                            <div class="blog-pagination__block mb-md-2 mb-4 custom_center_class">
                                @if(isset($prevBlog) && !empty($prevBlog))
                                    <span class="text-uppercase d-block blog-pagination__pagination-name mb-2">
                                    Previous Post
                                </span>
                                    <a href="{{route('blog.details',[$user->user_name, $prevBlog->slug])}}"
                                       class="text-decoration-none text-dark-blue blog-pagination__post-link custom_pagination_link">
                                        <i class="fa fa-arrow-left mr-2" aria-hidden="true"></i>
                                        {{$prevBlog->title}}
                                    </a>
                                @endif
                            </div>
                            <div class="blog-pagination__block text-right mb-2 custom_center_class">
                                @if(isset($nexBlog) && !empty($nexBlog))
                                    <span
                                            class="text-uppercase d-block blog-pagination__pagination-name mb-2 color-danger">
                                    Next Post
                                </span>
                                    <div class="d-flex custom_next_link">
                                        <a href="{{route('blog.details',[$user->user_name, $nexBlog->slug])}}"
                                           class="text-decoration-none text-dark-blue blog-pagination__post-link text-left custom_pagination_link">
                                            {{$nexBlog->title}}
                                        </a>
                                        <a href="{{route('blog.details',[$user->user_name, $nexBlog->slug])}}">
                                            <i class="fa fa-arrow-right ml-2 next_arrow_icon" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('page_js')
    <script src="{{asset('assets/js/lazyload.min.js')}}"></script>
    <script src="{{asset('assets/js/web/lazyload/lazyload.js')}}"></script>
@endsection
