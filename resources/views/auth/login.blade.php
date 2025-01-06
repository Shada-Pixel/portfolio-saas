@extends('layouts.auth')
@section('title')
    LogIn
@endsection
@section('content')
    @php
        $adminSettings = getAdminSettings();
    @endphp
    <div class="login-page">
        <!-- Page content -->
        <div class="container">
            <!-- Header -->
            <div class="header">
                <div class="container">
                    <div class="header-body text-center mb-4">
                        <div class="row justify-content-center d-flex align-items-center">
                            <a href="{{ route('front') }}" class="d-flex">
                                <img class="navbar-brand-img login-img object-cover mr-2 mb-0 login-logo"
                                     src="{{ $adminSettings['company_logo'] }}"
                                     width="65" height="35" alt="Infyom Logo"/>
                                <h1 class="text-dark mb-0">{{ $adminSettings['company_name'] }}</h1>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card login-card border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center login-heading">
                                <h1 class="text-dark login-sign mb-2">Sign In to Portfolio</h1>
                                <div class="login-text">New Here?
                                    <a href="{{ route('user.register') }}" class="link-primary login-link">Create an Account</a></div>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger p-0 custom_alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class="mt-3">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (!empty(session('message')))
                                <div class="alert alert-danger py-3">
                                    <span>{{ session('message') }}</span>
                                    <form class="d-inline float-right" method="GET"
                                          action="{{ route('resend.verification.email') }}">
                                        @csrf
                                        <input type="hidden" name="user-email" value="{{ session('userEmail') }}">
                                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline"
                                                title="Resend Verification Email">
                                            <i class="fa fa-envelope text-white"></i>
                                        </button>
                                    </form>
                                </div>
                            @endif
                            @include('flash::message')
                            <div class="text-center text-muted mb-4"></div>
                            <form method="POST" action="{{ route('login') }}" id="loginForm">
                                @csrf
                                <input type="hidden" name="route_name"
                                       value="{{ app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName() }}">
                                <div class="form-group mb-4 email-section">
                                    <label class="form-label text-dark custom-label">Email:</label><span
                                            class="text-danger">* </span>
                                    <div>
                                        <input type="email" class="form-control {{ $errors->any()?'is-invalid':'' }}"
                                               name="email" tabindex="1" placeholder="Email" required id="email"
                                               value="{{ (Cookie::get('email') !== null) ? Cookie::get('email') : old('email') }}">
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                </div>
                                <div class="form-group password-section">
                                    <div class="d-flex justify-content-between">
                                        <label class="form-label text-dark custom-label">Password:<span
                                                    class="text-danger login-star">*</span></label>
                                        <a href="{{route('password.request')}}" class="link-primary"><small
                                                    class="custom-link">Forgot password ?</small></a>
                                    </div>
                                    <div>
                                        <input class="form-control password {{ $errors->has('password') ? ' is-invalid': '' }}"
                                               placeholder="Password" type="password" name="password" required
                                               value="{{ (Cookie::get('password') !== null) ? Cookie::get('password') : null }}"
                                               tabindex="2">
                                    </div>
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                </div>
                                <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                           id="remember" {{ (Cookie::get('remember') !== null) ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">
                                        <span class="text-muted">Remember me</span>
                                    </label>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100" id="btnLogin"
                                            data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">
                                        Sign in
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
@endpush
@section('page_js')
    <script>
        let hasUserEmailVerified = "{{ session('verifyEmail') }}";
        @if(empty(session('message')))
        setTimeout(function () { $('.alert').slideUp(500); }, 3000);
        @endif
    </script>
    <script src="{{ mix('assets/js/login/login.js') }}"></script>
@endsection
