@extends('layouts.web.app')
@section('title')
    {{ getAdminUserName() }}
@endsection
@section('page_css')
    <link rel="stylesheet" href="{{ asset('assets/css/summernote.min.css') }}">
    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    @php
        $adminSettings = getAdminSettings();
    @endphp
    @include('web.sections.profile')
    @include('web.sections.about_me')
    @include('web.sections.education_profile')
    @include('web.sections.recent_work')
    @include('web.sections.pricing_plan')
    @include('web.sections.skills')
    @include('web.sections.services')
    @include('web.sections.posts')
    @include('web.sections.testimonial')
    @if(getLoggedInUser() == null)
        @include('web.sections.contact_us')
    @endif
    @include('hire_me.create_model')
@endsection
<script>
    let isEdit = false;
    let totalSkills = "{{count($skills)}}";
    let userName = "{{ $user->user_name }}";
</script>

@section('page_js')
    <script src="{{ mix('assets/js/custom/phone-number-code.js') }}"></script>
    <script src="{{ mix('assets/js/custom/input-price-format.js') }}"></script>
    <script src="{{ asset('js/international-Telephone-Input.js') }}"></script>
    <script src="{{ asset('assets/js/circular_progress_bar.js') }}"></script>
    <script src="{{ asset('assets/js/web/enquiry/enquiry.js') }}"></script>
    <script src="{{ asset('assets/js/web/hire_me/hire_me.js')}}"></script>
    <script src="{{ mix('assets/js/web/home/home.js')}}"></script>
    <script src="{{ asset('assets/js/summernote.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/lazyload.min.js')}}"></script>
    <script src="{{ asset('assets/js/web/lazyload/lazyload.js')}}"></script>
@endsection
