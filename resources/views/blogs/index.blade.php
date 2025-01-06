@extends('layouts.app')
@section('title')
{{__('messages.blogs_category.posts')}}
@endsection
@section('css')
    {{--    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>--}}
    <link rel="stylesheet" href="{{asset('css/stretchy-navigation.css')}}">
    @livewireStyles
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 content-blog-responsive">
                    <div class="col-lg-3 col-md-3 col-5 custom-post-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.blogs_category.posts')}}</h6>
                    </div>
                    <div class="col-lg-9 col-md-9 col-7 text-right d-flex blog-alignment">
                        <div class="ml-auto text-right  text-center custom_blog_button mt-2rem">
                            {{Form::select('status', $status, null, ['id' => 'status_filter', 'class' => 'form-control', 'placeholder' => __('messages.blog_placeholder.select_status')]) }}
                        </div>
                        <div class="text-right  text-center blog_header_button mt-2rem">
                            {{Form::select('type', $categories, null, ['id' => 'category_filter', 'class' => 'form-control', 'placeholder' => __('messages.blog_placeholder.select_category')]) }}
                        </div>
                        <div class="mt-2rem custom_post_button">
                            <a href="{{route('blogs.create')}}" class="btn btn-group-lg btn-neutral btn-post-size">{{__('messages.blogs_category.new_post')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="card mb-4">
            <div class="card-body">
                @include('flash::message')
                @include('layouts.errors')
                @livewire('blogs')
            </div>
        </div>
        @include('blogs.templates.templates')
    </div>
@endsection
@section('scripts')
    @livewireScripts
    {{--    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>--}}
    {{--    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>--}}
    {{--    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>--}}
    <script src="{{mix('assets/js/blogs/blogs.js')}}"></script>
@endsection
