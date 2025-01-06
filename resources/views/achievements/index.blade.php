@extends('layouts.app')
@section('title')
    {{__('messages.achievements')}}
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}"  type="text/css"/>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-iconpicker.min.css')}}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/nano.min.css') }}">
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 custom-content">
                    <div class="col-lg-6 col-6 achievement-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.achievements')}}</h6>
                    </div>
                    <div class="col-lg-6 col-6 text-right achievement-btn">
                        <a href="#" class="btn btn-group-lg btn-neutral achievementModal custom_btn">{{__('messages.achievement.new_achievement')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="card mb-4">
            <div class="card-body">
                @include('achievements.table')
                @include('achievements.edit_model')
                @include('achievements.create_model')
                @include('achievements.show')
            </div>
        </div>
        @include('achievements.templates.templates')
    </div>
@endsection
@section('page_js')
    <script src="{{ asset('assets/js/pickr.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/color-picker.js') }}"></script>
@endsection
@section('scripts')
     <script>
        let achievementDefaultColor = '#f5365c';
        let achievementDescription = '{{__('messages.achievement.achievement_description')}}'
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/about_me/about_me.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-iconpicker.bundle.min.js')}}"></script>
@endsection
