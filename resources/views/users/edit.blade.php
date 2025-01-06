@extends('layouts.app')
@section('title')
    {{__('messages.edit_user')}}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/intel/css/intlTelInput.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/summernote.min.css') }}">
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.profile')}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 edit-user-div">
                        @include('flash::message')
                        @include('layouts.errors')
                        <div class="alert alert-danger d-none" id="validationErrorsBox"></div>

                        @include('users.user-profile-image')

                        {{ Form::model($user,['route' => ['users.update',$user->id],'method'=>'put','id' =>'updateUserForm']) }}
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        @include('users.edit_fields')
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    let countryId = '{{$user->country_id}}';
    let stateId = '{{$user->state_id}}';
    let cityId = '{{$user->city_id}}';
    let isEdit = true;
    let phoneNo = "{{ !empty($user) ? (($user->region_code).($user->phone)) : null }}"
    let aboutMeText = "{{ __('messages.about_me_text') }}";
    let selectState = "{{ __('messages.select_state') }}";
    let selectCity = "{{ __('messages.select_city') }}";
    let regionCode = "{{ $user->region_code }}";
    let themeLayout = {{ getSettingValue('theme_layout') }};
</script>
@section('page_js')
    <script src="{{ mix('assets/js/custom/phone-number-code.js') }}"></script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{mix('assets/js/users/users.js')}}"></script>
    <script src="{{ mix('assets/js/custom/country-state-city.js') }}"></script>
@endsection
