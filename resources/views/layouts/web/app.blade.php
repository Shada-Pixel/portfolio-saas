<!DOCTYPE html>
<html lang="en">
<head>
    @php
        $adminSettings = getAdminSettings();
    @endphp
    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="To manage the InfyOm Portfolio">
    <title>@yield('title') | {{config('app.name')}} </title>
    <link rel="icon" href="{{ asset($adminSettings['favicon']) }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts.web.css')

    @yield('page_css')
    @yield('css')
    @routes
</head>
<body>
@if(!Request::is('p/'.$user->user_name.'/blog*') && !Request::is('p/'.$user->user_name.'/search-blog*'))
    <header class="d-lg-flex align-items-center justify-content-lg-center justify-content-end">
        @include('layouts.web.header')
    </header>
    <!-- main part starts -->
    <main class="main-page main-page-custom">
        <div class="overlay-body"></div>
        <a id="top_button" class="d-flex justify-content-center align-items-center"><i
                    class="fas fa-arrow-up text-white"></i> </a>
        <div id="wrapper">
            <div id="circle_id" class="circle icon">
                <span class="line top"></span>
                <span class="line middle"></span>
                <span class="line bottom"></span>
            </div>
        </div>
        <div class="fixed-plugin">
            <div class="click_show">
                <a href="#/" data-toggle="dropdown" aria-expanded="true">
                    <i class="fa fa-cog"></i>
                </a>
                <ul class="dropdown-menu show">
                    <li class="adjustments-line text-center">
                            <i class="fas fa-toggle-on go_home"></i>
                        <span class="color-label">LIGHT MODE</span>
                        <span class="badge light-badge mr-2 ml-2 active-badge" id="lightThemeBadge"></span>
                        <span class="badge dark-badge ml-2 mr-2" id="darkThemeBadge"></span>
                        <span class="color-label">DARK MODE</span>
                    </li>
                </ul>
            </div>
        </div>
        @yield('content')
    </main>
    <footer class="copyright text-center p-4 bg-white mt-5 position-sticky sticky_footer custom-footer-width">
        @include('layouts.web.footer')
    </footer>
@else
    <!-- main part starts -->
    <main class="main-page w-100" id="webApp">
        <div class="fixed-plugin">
            <div class="click_show">
                <a href="#/" data-toggle="dropdown" aria-expanded="true">
                    <i class="fa fa-cog"></i>
                </a>
                <ul class="dropdown-menu show">
                    <li class="adjustments-line text-center">
                            <i class="fas fa-toggle-on go_home"></i>
                        <span class="color-label">LIGHT MODE</span>
                        <span class="badge light-badge mr-2 ml-2 active-badge" id="lightThemeBadge"></span>
                        <span class="badge dark-badge ml-2 mr-2" id="darkThemeBadge"></span>
                        <span class="color-label">DARK MODE</span>
                    </li>
                </ul>
            </div>
        </div>
        @yield('content')
    </main>
    <footer class="copyright text-center p-4 bg-white w-100 web-side-footer">
        @include('layouts.web.footer')
    </footer>
@endif

@include('layouts.web.js')
@yield('page_js')
@yield('scripts')

</body>
</html>
