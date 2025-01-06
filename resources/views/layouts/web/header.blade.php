<nav class="navbar navbar-expand navbar-light">
    <a class="navbar-brand"
       href="{{ route('front') }}">
        <img src="{{ asset($adminSettings['company_logo']) }}" class="logo-img" width="75" height="35" alt="">
    </a>
    <div class="side-header navbar-collapse collapse custom_web_sidebar"
         id="responsive-navbar-nav">
        <ul class="navbar-nav custom_web_navbar justify-content-end">
            <li class="nav-item nav-active mb-0 d-lg-block profile px-1">
                <a class="nav-link position-relative" href="{{route('portfolio.front', $user->user_name)}}">
                    <i class="fas fa-home header-icon w-25"></i>
                    <span class="w-75">Profile</span>
                </a>
            </li>
            @if(\App\Models\Achievement::count() > 0)
                <li class="nav-item mb-0 d-lg-block achivements px-1">
                    <a class="nav-link position-relative" href="#achivements">
                        <i class="fas fa-trophy header-icon w-25"></i>
                        <span class="w-75">About Me</span>
                    </a>
                </li>
            @endif
            @if(\App\Models\Education::count() > 0 || \App\Models\Experience::count() > 0)
                <li class="nav-item mb-0 d-lg-block education-profile px-1">
                    <a class="nav-link position-relative" href="#education-profile">
                        <i class="fas fa-graduation-cap header-icon w-25"></i>
                        <span class="w-75">Education</span>
                    </a>
                </li>
            @endif
            @if(\App\Models\RecentWork::count() > 0)
                <li class="nav-item mb-0 d-lg-block recent-work px-1">
                    <a class="nav-link position-relative" href="#recent-work">
                        <i class="fas fa-layer-group header-icon w-25"></i>
                        <span class="w-75">Recent Work</span>
                    </a>
                </li>
            @endif
            @if(\App\Models\PricingPlan::count() > 0)
                <li class="nav-item mb-0 d-lg-block pricing-plan px-1">
                    <a class="nav-link position-relative" href="#pricing-plan">
                        <i class="fas fa-hand-holding-usd header-icon w-25"></i>
                        <span class="w-75">Pricing Plan</span>
                    </a>
                </li>
            @endif
            @if(\App\Models\Skill::count() > 0)
                <li class="nav-item mb-0 d-lg-block skills px-1">
                    <a class="nav-link position-relative" href="#skills">
                        <i class="fas fa-clipboard-list header-icon w-25"></i>
                        <span class="w-75">Skill</span>
                    </a>
                </li>
            @endif
            @if(\App\Models\Service::count() >  0)
                <li class="nav-item mb-0 d-lg-block service px-1">
                    <a class="nav-link position-relative" href="#service">
                        <i class="fas fa-wrench header-icon w-25"></i>
                        <span class="w-75">Service</span>
                    </a>
                </li>
            @endif
            @if(\App\Models\Blog::isPublished()->count() >  0)
                <li class="nav-item mb-0 d-lg-block latest-post px-1">
                    <a class="nav-link position-relative" href="#latest-post">
                        <i class="fab fa-blogger-b header-icon w-25"></i>
                        <span class="w-75">Latest Post</span>
                    </a>
                </li>
            @endif
            @if(\App\Models\Testimonial::count() >  0)
                <li class="nav-item mb-0 d-lg-block testimonial px-1">
                    <a class="nav-link position-relative" href="#testimonial">
                        <i class="fas fa-sticky-note header-icon w-25"></i>
                        <span class="w-75">Testimonial</span>
                    </a>
                </li>
            @endif
            @if(getLoggedInUser() == null)
                <li class="nav-item mb-0 d-lg-block contact px-1">
                    <a class="nav-link position-relative" href="#contact">
                        <i class="fas fa-comments header-icon w-25"></i>
                        <span class="w-75">Contact Us</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>
