<!doctype html>
<html lang="en">
<head>
    @php
        $adminSettings = getAdminSettings();
    @endphp
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="To manage the InfyOm Portfolio">
    <title>@yield('title') | {{config('app.name')}} </title>
    <link rel="icon" href="{{ asset($adminSettings['favicon']) }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('web.new_theme_three.css')

    @yield('page_css')
    @yield('css')
    @routes
</head>
<body>
@if(!Request::is('p/'.$user->user_name.'/blog*') && !Request::is('p/'.$user->user_name.'/search-blog*'))
    <div class="header">
        @include('web.new_theme_three.header')
    </div>
@endif
<div id="wrapper" class="clearfix">
    @yield('content')
</div>
<footer>
    @include('web.new_theme_three.footer')
</footer>
<a id="go-to-top" class="d-flex justify-content-center align-items-center"><i class="fas fa-arrow-up text-white"></i>
</a>
<!-- main part starts -->
@include('web.new_theme_three.js')
@yield('page_js')
@yield('scripts')

</body>
</html>
