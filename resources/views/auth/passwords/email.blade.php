@extends('layouts.auth')
@section('title')
    Reset Password
@endsection
@section('content')

    <div class="forgotpassword-card">
        <div class="container">
            <div class="header">
                <div class="container">
                    <div class="header-body text-center mb-4">
                        <div class="row justify-content-center d-flex align-items-center">
                            <a href="{{ route('front') }}" class="d-flex">
                                <img class="navbar-brand-img login-img object-cover mr-2 mb-0"
                                     src={{ getAdminSettingValue('company_logo') }}
                                             width="65" height="35" alt="Infyom Logo"/>
                                <h1 class="text-dark mb-0">{{ getAdminSettingValue('company_name') }}</h1>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-7">
                    <div class="card forgot-card border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center mb-10">
                                <h1 class="text-dark mb-2 forgot-titile">Forgot Password ?</h1>
                                <div class="text-gray-400 fw-bold fs-4 forgot-pera">Enter your email to reset your
                                    password.
                                </div>
                            </div>
                            <div class="card-body pb-0">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <form method="POST" action="{{ url('/password/email') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="email"
                                               class="forgot-label">{{ __('messages.email').':' }}<span
                                                    class="text-danger">*</span></label>

                                        <div>
                                            <input id="email" type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email"
                                                   value="{{ old('email') }}" required autocomplete="email" placeholder="Email" autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group mb-0">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary forgot-btn">
                                                {{ __('messages.send_reset_link') }}
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group pt-3">
                                        <div class="text-center">
                                            <a href="{{ route('login') }}">{{ __('messages.back_sigin') }}</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
