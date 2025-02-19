<header id="header" class="border-bottom-0 no-sticky transparent-header">
    <div id="header-wrap">
        <div class="container">
            <div class="header-row">

                <!-- Logo
                ============================================= -->
                <div id="logo">
                    <a href="{{ route('front') }}" class="standard-logo d-block">
                        <img src="{{ $adminSettings['company_logo'] }}" alt="InfyPortfolio Logo" class="h-50">
                    </a>
                </div><!-- #logo end -->

                <div class="header-misc">
                    @if(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->hasRole('super_admin'))
                        <a href="{{route('dashboard')}}"
                           class="button button-border rounded-pill">{{__('messages.dashboard.dashboard')}}</a>
                    @elseif(\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                        <a href="{{route('users.edit', getLoggedInUserId()) }}"
                           class="button button-border rounded-pill">{{__('messages.my_profile')}}</a>
                    @else
                        <a href="{{route('login')}}" class="button button-border rounded-pill">{{__('messages.sign_in')}}</a>
                    @endif
                </div>

                <div id="primary-menu-trigger">
                    <svg class="svg-trigger" viewBox="0 0 100 100">
                        <path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path>
                        <path d="m 30,50 h 40"></path>
                        <path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path>
                    </svg>
                </div>

                <!-- Primary Navigation
                ============================================= -->
                <nav class="primary-menu">
                    <ul class="menu-container">
                        <li class="menu-item">
                            <a class="menu-link {{ Request::is('portfolio*')? 'active' : ''}}"
                               href="{{ route('front.portfolio.index') }}">
                                <div>Featured Portfolio's</div>
                            </a>
                        </li>
                        @if(getLoggedInUser() == null || getLoggedInUser()->hasRole('admin'))
                            <li class="menu-item">
                                <a class="menu-link {{ Request::is('pricing') || Request::is('pricing-payment-method*') ? 'active' : ''}}"
                                   href="{{ route('front.pricing') }}">
                                    <div>Pricing</div>
                                </a>
                            </li>
                        @endif
                        <li class="menu-item">
                            <a class="menu-link" href="#" data-scrollto="#footer" data-easing="easeInOutExpo"
                               data-speed="1250" data-offset="70">
                                <div>Contact</div>
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>
        </div>
    </div>
</header>
