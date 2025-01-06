<!DOCTYPE html>
<html lang="en">
<head>
    @php
        $adminSettings = getAdminSettings();
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="To manage the InfyOm Portfolio">
    <meta name="author" content="InfyOm Technologies">

    <title>@yield('title') | {{config('app.name')}} </title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset($adminSettings['favicon']) }}" type="image/png">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link href="//fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link href="{{ asset('assets/password-strength-meter/dist/password.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
    <link href="{{ asset('assets/css/sweetalert2.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/argon.css') }}" type="text/css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <link href="{{ asset('assets/css/phone-number-code.css') }}" rel="stylesheet" type="text/css"/>
    <!-- CSS Libraries -->
    @yield('page_css')
    @yield('css')
    @routes
    <!-- Template CSS -->
</head>
<body >
@include('layouts.sidebar')
@stack('sidebar_js')

<div class="main-content min-vh-100 d-flex flex-column justify-content-between" id="panel">

    <div>
    @include('layouts.header')

    
    @yield('content')
 </div>
    @include('layouts.footer')
    
</div>

@include('profile.change_password')
@include('profile.edit_profile')
@include('profile.change_langauge')
<!-- Scripts -->
<script src="{{ asset('vendor/js-cookie/js.cookie.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ mix('assets/js/sidebar_menu_search/sidebar_menu_search.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/password-strength-meter/dist/password.min.js') }}"></script>

<script src="{{ asset('js/argon.js') }}"></script>
@yield('page_js')
@yield('scripts')
<script src="{{ mix('assets/js/app/app.js') }}"></script>
<script>
    let pdfDocumentImageUrl = "{{asset('assets/img/pdf_icon.png')}}"
    let docxDocumentImageUrl = "{{asset('assets/img/doc_icon.png')}}"
    let xlsxDocumentImageUrl = "{{asset('assets/img/xlsx_icon.png')}}"
    let defaultImage = "{{asset('img/infyom-logo.png')}}"
    let successMessage = "{{ session('successMessage') }}"
    let iconUrl = '{{asset('assets/web/css/images/done.png')}}'
</script>
<script src="{{ mix('assets/js/custom/custom.js') }}"></script>
<script src="{{ mix('assets/js/user-profile/user-profile.js') }}"></script>
</body>
</html>
