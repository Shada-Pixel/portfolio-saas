@extends('layouts.auth')
@section('title')
    Reset Password
@endsection
@section('content')

    <div class="resetpass-page">
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
                <div class="col-md-7">
                    <div class="card reset-card border-0 mb-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center mb-10">
                                <h1 class="text-dark mb-2 reset-titile">{{ __('messages.reset_password') }}</h1>
                                <div class="text-gray-400 fw-bold fs-4 reset-pera">Enter your email to reset your
                                    password.
                                </div>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf

                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="form-group">
                                        <label for="email"
                                               class="col-form-label reset-label">{{ __('messages.email') }}</label>
                                        <span class="text-danger">*</span>
                                        <div>
                                            <input id="email" type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email"
                                                   value="{{ $email ?? old('email') }}" required autocomplete="email"
                                                   autofocus>

                                            @error('email')
                                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password"
                                               class="col-form-label reset-label">{{ __('messages.admin_users.password') }}</label>
                                        <span class="text-danger">*</span>
                                        <div>
                                            <input id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password" required autocomplete="new-password">

                                            @error('password')
                                            <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="password-confirm"
                                               class="col-form-label reset-label">{{ __('messages.admin_users.confirm_password') }}</label>
                                        <span class="text-danger">*</span>
                                        <div>
                                            <input id="password-confirm" type="password" class="form-control"
                                                   name="password_confirmation" required autocomplete="new-password">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('messages.reset_password') }}
                                            </button>

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
