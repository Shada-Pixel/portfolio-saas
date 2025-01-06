@extends('layouts.app')
@section('title')
    {{__('messages.blogs_category.edit_post')}}
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/summernote.min.css') }}">
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 custom-edit-post">
                    <div class="col-lg-6 col-7 custom-edit-text">
                        <h6 class="h2 text-white d-inline-block mb-0">    {{__('messages.blogs_category.edit_post')}}
                        </h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right custom-edit-post-btn">
                        <a href="{{route('blogs.index')}}" class="btn btn-group-lg btn-neutral edit-post-btn">{{__('messages.back')}}</a>
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
                {{ Form::open(['route' => ['blogs.update',$blog->id],'method'=>'put','files' => true ,'id'=>'updateBlogForm']) }}
                <input type="hidden" name="id" value="{{ $blog->id }}">
                @include('blogs.edit_fields')
                {{ Form::close() }}
            </div>
        </div>
        @include('categories.create_model')
    </div>
@endsection
@section('page_js')
    <script>
        let blogBody = '{{__('messages.blog_placeholder.blog_body')}}';
    </script>
    <script src="{{ mix('assets/js/blogs/create-edit.js') }}"></script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
@endsection
