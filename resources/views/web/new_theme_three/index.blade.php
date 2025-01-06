@extends('web.new_theme_three.app')
@section('title')
    {{ getAdminUserName() }}
@endsection
@php
    $adminSettings = getAdminSettings();
@endphp
@section('page_css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
@endsection
@section('content')
    {{--    profile--}}
    @include('web.new_theme_three.sections.profile')
    {{--About Me--}}
    @include('web.new_theme_three.sections.about_me')
    {{--    Education & Experience--}}
    @include('web.new_theme_three.sections.education_profile')
    {{--    Recent-work--}}
    @include('web.new_theme_three.sections.recent_work')
    {{--    Pricing Plan--}}
    @include('web.new_theme_three.sections.pricing_plan')
    {{--    skills--}}
    @include('web.new_theme_three.sections.skills')
    {{--    services--}}
    @include('web.new_theme_three.sections.services')
    {{--    Latest Post--}}
    @include('web.new_theme_three.sections.posts')
    {{--    testimonial--}}
    @include('web.new_theme_three.sections.testimonial')
    {{--    contact us--}}
    @if(getLoggedInUser() == null)
        @include('web.new_theme_three.sections.contact_us')
    @endif
    {{--    hire me modal--}}
    @include('hire_me.create_model')
@endsection
@section('scripts')
    <script>
        let userName = "{{ $user->user_name }}";
    </script>
    <script src="{{ mix('assets/web/js/new-theme-three.js')}}"></script>
@endsection
