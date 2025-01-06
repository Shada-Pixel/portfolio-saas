@extends('layouts.new_theme_web.app')
@section('title')
    {{ getAdminUserName() }}
@endsection
@section('page_css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
@endsection
@section('content')
    <header>
    </header>
    @include('web.new_theme_sections.profile')
    @include('web.new_theme_sections.about_me')
    @include('web.new_theme_sections.education_profile')
    @include('web.new_theme_sections.recent_work')
    @include('web.new_theme_sections.pricing_plan')
    @include('web.new_theme_sections.skills')
    @include('web.new_theme_sections.services')
    @include('web.new_theme_sections.posts')
    @include('web.new_theme_sections.testimonial')
    @if(getLoggedInUser() == null)
        @include('web.new_theme_sections.contact_us')
    @endif
    @include('hire_me.create_model')
@endsection
<script>
    let isEdit = false;
    let totalSkills = "{{count($skills)}}";
    let userName = "{{ $user->user_name }}";
</script>
@section('page_js')
    <script src="{{ mix('assets/web/js/new-theme-home.js')}}"></script>
@endsection
