@extends('layouts.web.app')
@section('title')
    Blogs
@endsection
@section('page_css')
    @livewireStyles
@endsection

@section('content')
    <section class="blog-page padding-top-100 padding-top-lg-30 padding-top-md-50">
        <a href="{{ url('p/'.$user->user_name) }}" class="position-fixed ml-4 front-home-btn"><i
                    class="fa fa-home fa-2x text-danger"></i></a>
        <div class="container">
            <div class="first-content text-center">
                <h1 class="position-relative mb-5">
                    @if(Request::is('p/'.$user->user_name.'/blog-category*'))
                        <span class="blog-category-border text-uppercase">{{$category->name}}'s &nbsp;Posts</span>
                        <div class="position-absolute back-button-blog d-flex justify-content-end"><a
                                    href="{{route('blog.lists', $user->user_name)}}"
                                    class="btn btn-primary text-center"><i class="fa fa-angle-left mr-2"></i>Back To
                                Listing Page</a></div>
                    @else
                        <span class="blog-category-border">Blog</span>
                    @endif
                </h1>
            </div>

            <div class="blog-page__blogs-block">
                <div class="row flex-column-reverse flex-lg-row">
                    <div class="col-xl-8 col-lg-7 padding-r-45 custom-blog-page">
                        {{ session(['tenant_user_name' => request()->segment(2)]) }}
                        @if(Request::is('p/'.$user->user_name.'/blog-category*'))
                            @livewire('blog-lists', ['category' => $category])
                        @else
                            @livewire('blog-lists')
                        @endif
                    </div>
                    <div class="col-xl-4 col-lg-5">
                        <div class="blog-page__search-box search-blog-list-padding">
                            <div class="blog-list-search-box position-relative d-inline-block w-100 blog-page__search-box__form">
                                <input wire:model.debounce.100ms="searchBlogList" type="search"
                                       class="search-box" placeholder="Search..."
                                       id="searchBlogList" autocomplete="off">
                                <span class="blog-page__search-btn">
                                    <i class="fa fa-search search-sign"></i>
                                    <i class="fas fa-times close-sign d-none"></i>
                                </span>
                            </div>
                        </div>
                        <div class="blog-page__blog-lists bg-white d-none d-lg-block custom-blog-show">
                            <h2 class="blog-page__blog-title mb-4">Featured Posts</h2>
                            <div class="list-group list-group-flush popular-blogs">
                                @if(count($data['topBlogs'] ) > 0)
                                    @foreach($data['topBlogs'] as $blog)
                                        <a href="{{route('blog.details',[$user->user_name, $blog->slug])}}"
                                           class="list-group-item border-top-0 list-group-item-action px-0 pt-3 pb-2">
                                            <div class="mb-1">
                                                <strong class="d-block popular-blogs__post-name">
                                                    {{$blog->title}}
                                                </strong>
                                                <span class="popular-blogs__text-inline">
                                                    <span class="popular-blogs__tag-name text-pink pr-1">
                                                         {{$blog->category->name}}
                                                    </span>
                                                    - {{ \Carbon\Carbon::parse($blog->created_at)->format('d M Y') }}
                                                </span>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <h4 class="dark-text">No Featured Post Found</h4>
                                @endif
                            </div>
                        </div>
                        <div class="blog-page__blog-lists bg-white mt-5 d-none d-lg-block custom-show-cat custom-blog-show">
                            <h2 class="blog-page__blog-title mb-4">Categories</h2>
                            <ul class="list-group list-group-flush custom_cat_ul">
                                @if(count($data['categories']) > 0)
                                    @foreach($data['categories'] as $category)
                                        <a href="{{route('category.blogs',[$user->user_name, $category->slug])}}"
                                           class="list-group-item border-top-0 mb-0 px-0 py-3 {{(Request::is('p/'.$user->user_name.'/blog-category*') && $category->slug == Request::segment(4)) ? 'active' : ''}} custom_cat_li">
                                            <span class="text-decoration-none text-dark pl-2">{{$category->name}}
                                                <span>({{$category->blogs->where('is_published', '=', \App\Models\Blog::PUBLISHED)->count()}})</span></span>
                                        </a>
                                    @endforeach
                                @else
                                    <h4 class="dark-text">No Categories Found</h4>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('page_js')
    @livewireScripts
    <script src="{{asset('assets/js/lazyload.min.js')}}"></script>
    <script src="{{asset('assets/js/web/lazyload/lazyload.js')}}"></script>
    <script src="{{asset('assets/js/web/blog_lists/blog_lists.js')}}"></script>
    <script>
        (function ($) {
            'use strict';
            document.addEventListener('livewire:load', function () {
                window.livewire.hook('message.processed', () => {
                    $(window).scrollTop(0);
                    let lazyload = new LazyLoad();
                });
            });
        })(jQuery);
    </script>
@endsection
