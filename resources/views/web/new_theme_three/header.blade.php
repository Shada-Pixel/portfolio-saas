<nav class="navbar navbar-expand-lg navbar-light side-menubar flex-column align-items-start">
        <div class="flex-column d-lg-block d-none text-center logo-section mb-3 mx-auto">
            <a class="navbar-brand logo-text"
               href="{{ (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()) ? route('users.edit', \Auth::id()) : '#'  }}">
                <div>
                    <img src="{{ asset($adminSettings['company_logo']) }}" class="logo-img" width="50" height="50" alt="">
                    <div class="mt-2">
                        <span>InfyPortfolio</span>
                    </div>

                </div>
            </a>
        </div>
    <div class="h-100 d-flex w-100">
        <div class="filter-backdrop"></div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger-container">
                <div class="hamburger" id="hamburger-11">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </div>
            </div>
        </button>
        <div class="collapse navbar-collapse custom-navbar-box" id="navbarSupportedContent">
            <div class="flex-column d-lg-none d-block text-center logo-section my-3 mx-auto">
                <a class="navbar-brand logo-text"
                   href="{{ (\Illuminate\Support\Facades\Auth::check() && \Illuminate\Support\Facades\Auth::user()) ? route('users.edit', \Auth::id()) : '#'  }}">
                    <div>
                        <img src="{{ asset($adminSettings['company_logo']) }}" class="logo-img" width="50" height="50" alt="">
                    </div>
                    <div class="mt-2">
                        <span>InfyPortfolio</span>
                    </div>
                </a>
            </div>
            <div class="d-flex flex-column h-100 justify-content-center navbar-link-items w-100">
                <ul class="navbar-nav mb-lg-0 ps-4 overflow-auto">
                    <li class="nav-item mb-3 d-flex align-items-center">
                        <img src="{{asset('assets/img/header-icon/profile.png')}}" alt="profile" width="25px"
                             height="25px">
                        <a class="nav-link sidebar-url profile ms-3" aria-current="page" href="#profile">Profile</a>
                    </li>
                    @if($aboutMe->count() > 0)
                        <li class="nav-item mb-3 d-flex align-items-center">
                            <img src="{{asset('assets/img/header-icon/about.png')}}" alt="about" width="25px"
                                 height="25px">
                            <a class="nav-link sidebar-url aboutMe ms-3" href="#aboutMe">About Me</a>
                        </li>
                    @endif
                    @if($experiences->count() > 0 || $educations->count() > 0)
                        <li class="nav-item mb-3 d-flex align-items-center">
                            <img src="{{asset('assets/img/header-icon/experience.png')}}" alt="experience" width="25px"
                                 height="25px">
                            <a class="nav-link sidebar-url experienceEducation ms-3"
                               href="#experienceEducation">Experience</a>
                        </li>
                    @endif
                    @if($recentWorksType->count() > 0)
                        <li class="nav-item mb-3 d-flex align-items-center">
                            <img src="{{asset('assets/img/header-icon/recentwork.png')}}" alt="recentwork" width="25px"
                                 height="25px">
                            <a class="nav-link sidebar-url recentWork ms-3" href="#recentWork">Recent Work</a>
                        </li>
                    @endif
                    @if($pricingPlans->count() > 0)
                        <li class="nav-item mb-3 d-flex align-items-center">
                            <img src="{{asset('assets/img/header-icon/pricing.png')}}" alt="pricing" width="25px"
                                 height="25px">
                            <a class="nav-link sidebar-url pricingPlan ms-3" href="#pricingPlan">Pricing Plan</a>
                        </li>
                    @endif
                    @if($skills->count() > 0)
                        <li class="nav-item mb-3 d-flex align-items-center">
                            <img src="{{asset('assets/img/header-icon/skill.png')}}" alt="skill" width="25px"
                                 height="25px">
                            <a class="nav-link sidebar-url skills ms-3" href="#skills">Skill</a>
                        </li>
                    @endif
                    @if($services->count() > 0)
                        <li class="nav-item mb-3 d-flex align-items-center">
                            <img src="{{asset('assets/img/header-icon/service.png')}}" alt="service" width="25px"
                                 height="25px">
                            <a class="nav-link sidebar-url services ms-3" href="#services">Service</a>
                        </li>
                    @endif
                    @if($blogs->count() > 0)
                        <li class="nav-item mb-3 d-flex align-items-center">
                            <img src="{{asset('assets/img/header-icon/latestpost.png')}}" alt="latestpost" width="25px"
                                 height="25px">
                            <a class="nav-link sidebar-url latestPost ms-3" href="#latestPost">Latest Post</a>
                        </li>
                    @endif
                    @if($testimonials->count() > 0)
                        <li class="nav-item mb-3 d-flex align-items-center">
                            <img src="{{asset('assets/img/header-icon/testimonial.png')}}" alt="testimonial"
                                 width="25px"
                                 height="25px">
                            <a class="nav-link sidebar-url testimonial ms-3" href="#testimonial">Testimonial</a>
                        </li>
                    @endif
                    @if(getLoggedInUser() == null)
                        <li class="nav-item mb-3 d-flex align-items-center">
                            <img src="{{asset('assets/img/header-icon/contactus.png')}}" alt="contactus" width="25px"
                                 height="25px">
                            <a class="nav-link sidebar-url contactUs ms-3" href="#contactUs">Contact Us</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>

    {{--            <div class="midnightHeader white">--}}
    {{--                <img src="{{ asset(getLogoUrl()) }}" class="header-img ps-4">--}}
    {{--                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"--}}
    {{--                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"--}}
    {{--                        aria-expanded="false" aria-label="Toggle navigation">--}}
    {{--                    <span class="navbar-toggler-icon"></span>--}}
    {{--                </button>--}}
    {{--                <div class="collapse navbar-collapse ps-4" id="navbarSupportedContent">--}}
    {{--                    <ul class="navbar-nav mt-3 mb-lg-0">--}}
    {{--                        <li class="nav-item mb-3 d-flex align-items-center">--}}
    {{--                            <img src="{{asset('assets/img/header-icon/profile.png')}}" alt="profile" width="25px"--}}
    {{--                                 height="25px">--}}
    {{--                            <a class="nav-link profile active ms-3" aria-current="page" href="#profile">Profile</a>--}}
    {{--                        </li>--}}
    {{--                        @if($aboutMe->count() > 0)--}}
    {{--                            <li class="nav-item mb-3 d-flex align-items-center">--}}
    {{--                                <img src="{{asset('assets/img/header-icon/about.png')}}" alt="about" width="25px" height="25px">--}}
    {{--                                <a class="nav-link aboutMe ms-3" href="#aboutMe">About Me</a>--}}
    {{--                            </li>--}}
    {{--                        @endif--}}
    {{--                        @if($experiences->count() > 0 || $educations->count() > 0)--}}
    {{--                            <li class="nav-item mb-3 d-flex align-items-center">--}}
    {{--                                <img src="{{asset('assets/img/header-icon/experience.png')}}" alt="experience" width="25px"--}}
    {{--                                     height="25px">--}}
    {{--                                <a class="nav-link experienceEducation ms-3" href="#experienceEducation">Experience</a>--}}
    {{--                            </li>--}}
    {{--                        @endif--}}
    {{--                        @if($recentWorksType->count() > 0)--}}
    {{--                            <li class="nav-item mb-3 d-flex align-items-center">--}}
    {{--                                <img src="{{asset('assets/img/header-icon/recentwork.png')}}" alt="recentwork" width="25px"--}}
    {{--                                     height="25px">--}}
    {{--                                <a class="nav-link recentWork ms-3" href="#recentWork">Recent Work</a>--}}
    {{--                            </li>--}}
    {{--                        @endif--}}
    {{--                        @if($pricingPlans->count() > 0)--}}
    {{--                            <li class="nav-item mb-3 d-flex align-items-center">--}}
    {{--                                <img src="{{asset('assets/img/header-icon/pricing.png')}}" alt="pricing" width="25px"--}}
    {{--                                     height="25px">--}}
    {{--                                <a class="nav-link pricingPlan ms-3" href="#pricingPlan">Pricing Plan</a>--}}
    {{--                            </li>--}}
    {{--                        @endif--}}
    {{--                        @if($skills->count() > 0)--}}
    {{--                            <li class="nav-item mb-3 d-flex align-items-center">--}}
    {{--                                <img src="{{asset('assets/img/header-icon/skill.png')}}" alt="skill" width="25px" height="25px">--}}
    {{--                                <a class="nav-link skills ms-3" href="#skills">Skill</a>--}}
    {{--                            </li>--}}
    {{--                        @endif--}}
    {{--                        @if($services->count() > 0)--}}
    {{--                            <li class="nav-item mb-3 d-flex align-items-center">--}}
    {{--                                <img src="{{asset('assets/img/header-icon/service.png')}}" alt="service" width="25px"--}}
    {{--                                     height="25px">--}}
    {{--                                <a class="nav-link services ms-3" href="#services">Service</a>--}}
    {{--                            </li>--}}
    {{--                        @endif--}}
    {{--                        @if($blogs->count() > 0)--}}
    {{--                            <li class="nav-item mb-3 d-flex align-items-center">--}}
    {{--                                <img src="{{asset('assets/img/header-icon/latestpost.png')}}" alt="latestpost" width="25px"--}}
    {{--                                     height="25px">--}}
    {{--                                <a class="nav-link latestPost ms-3" href="#latestPost">Latest Post</a>--}}
    {{--                            </li>--}}
    {{--                        @endif--}}
    {{--                        @if($testimonials->count() > 0)--}}
    {{--                            <li class="nav-item mb-3 d-flex align-items-center">--}}
    {{--                                <img src="{{asset('assets/img/header-icon/testimonial.png')}}" alt="testimonial" width="25px"--}}
    {{--                                     height="25px">--}}
    {{--                                <a class="nav-link testimonial ms-3" href="#testimonial">Testimonial</a>--}}
    {{--                            </li>--}}
    {{--                        @endif--}}
    {{--                        <li class="nav-item mb-3 d-flex align-items-center">--}}
    {{--                            <img src="{{asset('assets/img/header-icon/contactus.png')}}" alt="contactus" width="25px"--}}
    {{--                                 height="25px">--}}
    {{--                            <a class="nav-link contactUs ms-3" href="#contactUs">Contact Us</a>--}}
    {{--                        </li>--}}
    {{--                    </ul>--}}
    {{--                </div>--}}
    {{--            </div>--}}
</nav>
