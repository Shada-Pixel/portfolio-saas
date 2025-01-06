    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto d-xl-none">
                    <li class="nav-item">
                        <!-- Sidenav toggler -->
                        <div class="pr-3 admin_menu_icon" data-action="sidenav-pin"
                             data-target="#sidenav-main">
                            <div class="toggle_line">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav mr-auto d-xl-block d-none">
                <li class="nav-item">
                    {{-- desktop screen--}}
                    <div class="pr-3 desktop_admin_menu_icon">
                        <div class="toggle_line">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </li>
            </ul>
            @if(session('impersonated_by'))
                <a href="{{ route('impersonate.leave') }}"
                   class="mr-3 text-danger" data-toggle="tooltip"
                   title="{{__('messages.admin_users.return_to_admin')}}">
                    <i class="fas fa-user-check font-size-25px"></i>
                </a>
            @endif
            @role('admin')
            <a href="{{ url('p'.DIRECTORY_SEPARATOR.getLoggedInUser()->user_name) }}"
               class="mr-3 text-danger" target="_blank" data-toggle="tooltip"
               title="{{__('messages.user.preview_blog')}}">
                <i class="fas fa-eye font-size-25px"></i>
            </a>
            @endrole
            <ul class="navbar-nav align-items-center ml-0 ">
                <li class="dropdown language-menu no-hover mr-2">
                    <a href="{{ getLoggedInUser()->hasRole('super_admin') ? route('admin.settings.index') : route('settings.index') }}"
                       data-toggle="tooltip" title="{{__('messages.settings')}}">
                        <i class="fa fa-cog text-primary font-size-25px"></i>
                    </a>
                </li>
                {{--                <li class="dropdown language-menu no-hover ml-3">--}}
                {{--                    <a href="#" class="dropdown-toggle text-white text-decoration-none"--}}
                {{--                       data-toggle="dropdown" role="button">--}}
                {{--                        {{ strtoupper(getCurrentLanguageName()) }}&nbsp;--}}
                {{--                        EN--}}
                {{--                        <span class="caret"></span>--}}
                {{--                    </a>--}}
                {{--                    <div class="dropdown-menu dropdown-menu-right w-100" role="menu">--}}
                {{--                        @foreach(getUserLanguages() as $key => $value)--}}
                {{--                            <span class="language-item"><a href="javascript:void(0)" class="changeLanguage dropdown-item"--}}
{{--                                                           data-prefix-value="{{ $key }}">{{ $value }}</a></span>--}}
{{--                        @endforeach--}}
                {{--                    </div>--}}
                {{--                </li>--}}
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <div class="media align-items-center">
                  <span class="avatar avatar-sm rounded-circle">
                    <img alt="Image placeholder" src="{{Auth::user()->profile_image }}" class="bg-white">
                  </span>
                            <div class="media-body  ml-2  d-none d-lg-block">
                                <span class="mb-0 text-sm text-dark font-weight-bold">{{__('messages.user.hi')}},&nbsp;&nbsp;{{Auth::user()->full_name }}</span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu  dropdown-menu-right profile-dropdown ">
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">{{__('messages.user.welcome')}}
                                ,&nbsp;&nbsp;{{Auth::user()->full_name }}</h6>
                        </div>
                        <a href="#!" class="dropdown-item edit-profile" data-target="#editProfileModal"
                           data-toggle="modal" data-id="{{ auth()->id() }}">
                            <i class="ni ni-single-02 profile-icon"></i>
                            <span class="c-ml-2 profile-text">{{__('messages.user.edit_profile')}}</span>
                        </a>
                        @if(getLoggedInUser()->hasRole('admin'))
                            <a href="{{ route('subscription.pricing.plans.index') }}"
                               class="dropdown-item subscription_plan">
                                <i class="fas fa-rupee-sign"></i>
                                <span class="c-ml-10">{{__('messages.subscription_plan')}}</span>
                            </a>
                        @endif
                        <a href="" class="dropdown-item" data-toggle="modal" data-target="#changePasswordModal"
                           data-id="{{ auth()->id() }}">
                            <i class="ni ni-lock-circle-open password-icon"></i>
                            <span class="password-text">{{__('messages.user.change_password')}}</span>
                        </a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-id="{{ auth()->id() }}"
                           data-target="#changeLanguageModal"><i
                                    class="fa fa-language"></i>{{__('messages.user.change_language')}}</a>
                        @if(session('impersonated_by'))
                            <a class="dropdown-item" href="{{ route('impersonate.leave') }}">
                                <i class="fas fa-user-check"></i>{{__('messages.admin_users.return_to_admin')}}</a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <a href="{{ url('logout') }}" class="dropdown-item"
                           onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                            <i class="ni ni-button-power"></i>
                            <span>{{__('messages.user.logout')}}</span>
                        </a>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
