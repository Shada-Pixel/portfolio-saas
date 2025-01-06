@extends('layouts.app')
@section('title')
    {{__('messages.settings')}}
@endsection
@section('page_css')
    <link href="{{asset('assets/css/bootstrap-iconpicker.min.css')}}" rel="stylesheet" type="text/css"/>
    @if($sectionName == 'privacy-settings')
        <link rel="stylesheet" href="{{ asset('assets/css/summernote.min.css') }}">
    @endif
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-12">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.edit_settings')}}</h6>
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
                @include('settings.setting_menu')
            </div>
        </div>
    </div>
    @include('settings.templates.templates')
@endsection
<script>
    let isEdit = true;
    let phoneNo = "{{ old('region_code').old('phone') }}";
    {{--let phoneNo = "{{ !empty($user) ? (($user->region_code).($user->phone)) : null }}"--}}
    let uniqueId = 2;
</script>
@section('page_js')
    <script src="{{mix('assets/js/settings/settings.js')}}"></script>
    @if($sectionName == 'general')
        <script src="{{ mix('assets/js/custom/phone-number-code.js') }}"></script>
        <script>
            let regionCode = "{{ $settings['region_code'] }}";
            @if (getLoggedInUser() != null && getLoggedInUser()->hasRole('super_admin'))
            let defaultRegionCode = "{{ $settings['default_region_code']  }}";
            @endif
        </script>
    @endif
    @if($sectionName == 'privacy-settings')
        <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
        <script>
            let termsAndConditionsDescription = '{{__('messages.settings_placeholder.enter_terms_conditions')}}';
            let privacyPolicyDescription = '{{__('messages.settings_placeholder.enter_privacy_policy')}}';
            let termsAndConditions = {!! json_encode($settings['terms_conditions']) !!};
            let privacyPolicy = {!! json_encode($settings['privacy_policy']) !!};
        </script>
    @endif
@endsection
@section('scripts')
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap-iconpicker.bundle.min.js')}}"></script>
@endsection
