@extends('layouts.app')
@section('title')
    {{__('messages.blogs_category.create_post')}}
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/summernote.min.css') }}">
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 custom-new-post">
                    <div class="col-lg-6 col-7 custom-new-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.blogs_category.new_post')}}</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right new-post-btn">
                        <a href="{{route('blogs.index')}}" class="btn btn-group-lg btn-neutral post-btn">{{__('messages.back')}}</a>
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
                <div class="alert alert-danger d-none" id="validationErrorsBox"></div>
                {{ Form::open(['route' => 'blogs.store','method'=>'post', 'files' => true, 'id' =>'createBlogForm']) }}
                @include('blogs.fields')
                {{ Form::close() }}
            </div>
        </div>
        @include('categories.create_model')
        @include('blogs.templates.templates')
    </div>
@endsection
@section('page_js')
    <script>
        let blogBody = '{{__('messages.blog_placeholder.blog_body')}}';
    </script>
    <script src="{{ mix('assets/js/blogs/create-edit.js') }}"></script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
@endsection
