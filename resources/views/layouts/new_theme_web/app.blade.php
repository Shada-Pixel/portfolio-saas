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

    @include('layouts.new_theme_web.css')

    @yield('page_css')
    @yield('css')
    @routes
</head>
<body>
<div id="wrapper" class="clearfix">
    @if(!Request::is('p/'.$user->user_name.'/blog*') && !Request::is('p/'.$user->user_name.'/search-blog*'))
        @include('layouts.new_theme_web.header')
    @endif
    @yield('content')
    @include('layouts.new_theme_web.footer')
</div>
<a id="go-to-top" class="d-flex justify-content-center align-items-center"><i class="fas fa-arrow-up text-white"></i>
</a>
<script src="{{asset('assets/web/js/bootstrap-5/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/web/enquiry/enquiry.js') }}"></script>
<script src="{{asset('assets/js/iziToast.min.js')}}"></script>
<script src="{{ mix('assets/js/custom/phone-number-code.js') }}"></script>
<script src="{{asset('assets/js/custom/custom.js')}}"></script>
<script src="{{mix('assets/web/js/slick.min.js')}}"></script>
<script src="{{ asset('assets/js/summernote.min.js') }}"></script>
<script src="{{ mix('assets/js/custom/input-price-format.js') }}"></script>
<script src="{{ asset('assets/js/web/hire_me/hire_me.js')}}"></script>
<script src="{{ asset('assets/js/lazyload.min.js')}}"></script>
<script src="{{ asset('assets/js/web/lazyload/lazyload.js')}}"></script>
<script src="{{ asset('assets/js/aos.js') }}"></script>
<script src="{{ mix('assets/js/web/app/app.js') }}"></script>
@yield('page_js')
@yield('scripts')
</body>
</html>
