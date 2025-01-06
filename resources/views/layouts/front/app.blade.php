<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    @php
        $adminSettings = getAdminSettings();
    @endphp
    <!-- Required meta tags -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="InfyOm Technologies"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>@yield('title') | {{config('app.name')}} </title>
    <link rel="icon" href="{{ asset($adminSettings['favicon']) }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.front.css')
    @yield('page_css')
    @yield('css')
    @routes
</head>
<body class="stretched">
<div id="wrapper" class="clearfix">
    @include('layouts.front.header')
    @yield('content')
    @include('layouts.front.footer')
</div>

<div id="gotoTop" class="icon-double-angle-up bg-white text-dark rounded-circle shadow"></div>
@include('cookieConsent::index')
@include('layouts.front.js')
@yield('page_js')
@yield('scripts')

</body>
</html>
