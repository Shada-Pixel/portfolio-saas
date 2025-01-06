@extends('layouts.auth')
@section('title')
    Register
@endsection
@section('content')
    <!-- Header -->
    <div class="register-page">
    <!-- Page content -->
    <div class="container">
        <div class="header">
            <div class="container">
                <div class="header-body text-center mb-4">
                    <div class="row justify-content-center d-flex align-items-center">
                        <a href="{{ route('front') }}" class="d-flex">
                            <img class="navbar-brand-img login-img object-cover mr-2 mb-0"
                                 src="{{ getAdminSettingValue('company_logo') }}" width="65" height="35"
                                 alt="Infyom Logo"/>
                            <h1 class="text-dark login-header-title mb-0">{{ getAdminSettingValue('company_name') }}</h1>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card register-card border-0 mb-0">
                    <form method="post" action="{{ route('user.store') }}" id="registerForm">
                        <div class="card-body px-lg-5 py-lg-5">
                            @if ($errors->any())
                                <div class="alert alert-danger p-0 custom_alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li class="mt-3">{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @csrf
                                <div class="mb-5 text-center">
                                    <h1 class="text-dark mb-2 reg-heading">Create an Account</h1>
                                    <div class="reg-text">Already have an account?
                                        <a href="{{ route('login') }}" class="link-primary reg-link">Sign in here</a></div>
                                </div>
                         <div class="row">
                            <div class="form-group col-md-6">
                                <label class="reg-label">First Name:</label><span class="text-danger">* </span>
                                <input type="text" class="form-control" name="first_name"
                                       value="{{ old('first_name') }}" placeholder="First Name"
                                       required>
                            </div>
                             <div class="form-group col-md-6">
                                 <label class="reg-label">Last Name:</label><span class="text-danger">* </span>
                                 <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}"
                                        placeholder="Last Name"
                                        required>
                             </div>
                             <div class="form-group col-md-6">
                                 <label class="reg-label">Username:</label><span class="text-danger">* </span>
                                 <input type="text" name="user_name" id="username" class="form-control"
                                        value="{{ old('user_name') }}"
                                        placeholder="Username"
                                        required maxlength="20" pattern="[a-zA-Z0-9]+"
                                        title="The user name must only contain letters and numbers.">
                                 <span class="text-danger d-none username-error"></span>
                             </div>
                             <div class="form-group col-md-6">
                                 <label class="reg-label">Email:</label><span class="text-danger">* </span>
                                 <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                                        placeholder="Email" required>
                             </div>
                             <div class="form-group col-md-6">
                                 <label class="reg-label">Password:</label><span class="text-danger">* </span>
                                 <input type="password" name="password" class="form-control password"
                                        id="cPassword"
                                        placeholder="Password"
                                        required>
                             </div>
                             <div class="form-group col-md-6">
                                 <label class="reg-label">Confirm Password:</label><span class="text-danger">* </span>
                                 <input type="password" name="password_confirmation" class="form-control password"
                                        placeholder="Confirm Password" required>
                             </div>
                         </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" id="btnRegister"
                                            data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">
                                        Register
                                    </button>
                                </div>
                        </div>
                    </form>
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
        let checkUsernameUrl = '{{route('user.check.username')}}';
        setTimeout(function () { $('.alert').slideUp(500); }, 3000);
    </script>
    <script src="{{ mix('assets/js/login/login.js') }}"></script>
@endsection
