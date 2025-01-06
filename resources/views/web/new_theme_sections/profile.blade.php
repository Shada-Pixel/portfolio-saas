{{--profile-section--}}
<section class="pt-5 profile-section position-relative">
    <div class="container active-header" id="profile">
        <div class="profile-intro">
            <div class="profile-head d-flex justify-content-center align-items-center ">
                <img src="{{isset($user->media[0])?$user->profile_image:asset('img/infyom-logo.png')}} "
                     class="mb-lg-0 mb-5 profile-img rounded-circle">
                <div class="profile-content ms-4 mb-lg-0 mb-5">
                    <p class="mb-3 first-content">Hi,I am</p>
                    <h1 class="mb-3 large-heading">{{$user->full_name}}</h1>
                    <p class="mb-3 small-content">{{$user->job_title}}</p>
                    <p class="profile-info">{!! !empty($user->job_description) ? $user->job_description : '' !!}</p>
                    {{--                    <button type="button" class="btn download-btn btn-lg">Download CV</button>--}}
                    @if(getLoggedInUser() == null)
                        <button href="javascript:void(0)" type="button" class="btn contact-btn btn-lg" id="createModel">
                            Contact Me
                        </button>
                    @endif
                </div>
            </div>
            <div class="profile-icon text-center pb-3">
                <ul class="nav justify-content-center align-items-center ml-0 social-link">
                    @if(count($socialSettings) > 0)
                        @foreach($socialSettings as $socialSetting)
                            <li class="nav-item mb-0">
                                @if(!is_null($socialSetting->value))
                                    @if(strpos($socialSetting->value,'https://') !== false || strpos($socialSetting->value,'http://') !== false || is_null($socialSetting->value))
                                        <a class="nav-link text-dark social-icon-hover" href="{{$socialSetting->value}}"
                                           target="_blank">
                                            <i class="{{$socialSetting->key}} fa-3x"></i>
                                        </a>
                                    @else
                                        <a class="nav-link text-dark social-icon-hover"
                                           href="//{{$socialSetting->value}}"
                                           target="_blank">
                                            <i class="{{$socialSetting->key}} fa-3x"></i>
                                        </a>
                                    @endif
                                @endif
                            </li>
                        @endforeach
                    @endif
                </ul>

            </div>
        </div>
    </div>

    {{-- skill section--}}
    @if(!empty($user->experience) || !empty($user->project) || !empty($user->support))
        <div class="container skill-section">
            <div class="d-flex justify-content-center align-items-center">
                <div class="main-skills d-flex">
                    @if(!empty($user->experience))
                        <div class="d-flex align-items-center ms-3 mb-md-0 mb-4">
                            <div class="skills-icon d-flex justify-content-center align-items-center border-right">
                                <img src="{{asset('assets/img/Frame.png')}}" class="medal-img">
                            </div>
                            <div class="ms-3">
                                <span>{{ $user->experience }}+ Year Job</span>
                                <p class="mb-0">Experience</p>
                            </div>
                        </div>
                    @endif
                    @if(!empty($user->project))
                        <div class="d-flex align-items-center ms-3 mb-md-0 mb-4">
                            <div class="skills-icon d-flex justify-content-center align-items-center border-right">
                                <img src="{{asset('assets/img/vector.png')}}" class="vector-img">
                            </div>
                            <div class="ms-3">
                                <span>{{ $user->project  }}+ Projects</span>
                                <p class="mb-0">Completed</p>
                            </div>
                        </div>
                    @endif
                    @if(!empty($user->support))
                        <div class="d-flex align-items-center ms-3">
                            <div class="skills-icon d-flex justify-content-center align-items-center border-right">
                                <img src="{{asset('assets/img/headphone.png')}}" class="headphone-img">
                            </div>
                            <div class="ms-3">
                                <span>Support</span>
                                <p class="mb-0">{{ $user->support }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif
</section>
