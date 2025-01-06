<header class="custom-sticky-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a href="{{ route('front') }}">
                <img src="{{asset($adminSettings['company_logo'])}}" class="header-img">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link profile" aria-current="page" href="#profile">Profile</a>
                    </li>
                    @if($aboutMe->count() > 0)
                        <li class="nav-item">
                            <a class="nav-link aboutMe" href="#aboutMe">About Me</a>
                        </li>
                    @endif
                    @if($experiences->count() > 0 || $educations->count() > 0)
                        <li class="nav-item">
                            <a class="nav-link experienceEducation" href="#experienceEducation">Experience</a>
                        </li>
                    @endif
                    @if($recentWorksType->count() > 0)
                        <li class="nav-item">
                            <a class="nav-link recentWork" href="#recentWork">Recent Work</a>
                        </li>
                    @endif
                    @if($pricingPlans->count() > 0)
                        <li class="nav-item">
                            <a class="nav-link pricingPlan" href="#pricingPlan">Pricing Plan</a>
                        </li>
                    @endif
                    @if($skills->count() > 0)
                        <li class="nav-item">
                            <a class="nav-link skills" href="#skills">Skill</a>
                        </li>
                    @endif
                    @if($services->count() > 0)
                        <li class="nav-item">
                            <a class="nav-link services" href="#services">Service</a>
                        </li>
                    @endif
                    @if($blogs->count() > 0)
                        <li class="nav-item">
                            <a class="nav-link latestPost" href="#latestPost">Latest Post</a>
                        </li>
                    @endif
                    @if($testimonials->count() > 0)
                        <li class="nav-item">
                            <a class="nav-link testimonial" href="#testimonial">Testimonial</a>
                        </li>
                    @endif
                    @if(getLoggedInUser() == null)
                        <li class="nav-item">
                            <a class="nav-link contactUs" href="#contactUs">Contact Us</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
