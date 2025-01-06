@extends('layouts.app')
@section('title')
{{__('messages.blogs_category.categories')}}
@endsection
@section('css')
    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/summernote.min.css') }}">
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 custom-categories">
                    <div class="col-lg-6 col-6 custom-cat-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.blogs_category.categories')}}</h6>
                    </div>
                    <div class="col-lg-6 col-6 text-right categories-btn">
                        <a href="#" class="btn btn-group-lg btn-neutral custom-button-size" data-toggle="modal"
                           data-target="#categoryModal">{{__('messages.blogs_category.new_category')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="card mb-4">
            <div class="card-body">
                @include('categories.table')
            </div>
        </div>
        @include('categories.create_model')
        @include('categories.edit_model')
        @include('categories.show')
        @include('categories.templates.templates')
    </div>
@endsection
@section('scripts')
    <script>
        let categoryDescription = '{{__('messages.category_placeholder.category_description')}}'
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{mix('assets/js/categories/categories.js')}}"></script>
@endsection

