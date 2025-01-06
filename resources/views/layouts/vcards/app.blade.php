<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
    <!-- Required meta tags -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta name="author" content="InfyOm Technologies"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>@yield('title') | {{config('app.name')}} </title>
    <link rel="icon" href="{{ asset(getAdminSettingValue('favicon')) }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="//fonts.googleapis.com/css?family=Heebo:300,400,500,700,900" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/front/css/font-icons.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/fonts.css') }}" type="text/css"/>
    <!-- slick slider css  -->
    <link rel="stylesheet" href="{{asset('assets/web/css/slick.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/web/css/slick-theme.css')}}"/>

    @yield('page_css')
    @routes
</head>
<body class="stretched">
<div id="wrapper" class="clearfix">
    @yield('content')
    @include('front.vcards.cards.modal')
    @include('front.vcards.cards.share_vcard_modal')
</div>
</body>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/front/js/plugins.min.js') }}"></script>
<script src="{{mix('assets/web/js/slick.min.js')}}"></script>
<script src="{{ mix('assets/js/front/vcards/vcard.js') }}"></script>

</html>
