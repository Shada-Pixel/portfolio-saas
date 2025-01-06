{{--profile-section--}}
<section class="py-sm-5 py-4 profile-section position-relative active-link-class" id="profile">
    <div class="container">
        <div class="profile-intro">
            <div class="profile-head">
                <img src="{{asset(isset($user->media[0])?$user->profile_image:asset('img/infyom-logo.png'))}}"
                     class="mb-5 rounded-circle profile-img">
                <div class="profile-content mb-lg-0 mb-sm-5 mb-4">
                    <p class="mb-3 first-content">Hi World! I am</p>
                    <h1 class="mb-3 large-heading">{{$user->full_name}}</h1>
                    <p class="mb-3 small-content">{{$user->job_title}}</p>
                    <div class="text-center">
                        <p class="profile-info">{!! !empty($user->job_description) ? $user->job_description : '' !!}</p>
                    </div>
                    {{--                    <button type="button" class="btn download-btn btn-lg me-2">Download CV</button>--}}
                    @if(getLoggedInUser() == null)
                        <button type="button" class="btn contact-btn btn-lg" id="createModel">Contact Me</button>
                    @endif
                </div>
            </div>
            <div class="profile-icon text-center">
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
</section>

{{-- skill section--}}
@if(!empty($user->experience) || !empty($user->project) || !empty($user->support))
    <div class="container skill-section mt-5 py-xl-5">
        <div class="">
            <div class="row d-flex justify-content-center">
                @if(!empty($user->experience))
                    <div class="col-xl-3 col-lg-4 mb-xl-0 mb-3">
                        <div class="card border-0 skill-card">
                            <div class="card-body d-flex align-items-center">
                                <div class="skill-icon d-flex justify-content-center align-items-center">
                                    <img src="{{asset('assets/img/Frame.png')}}" class="medal-img">
                                </div>
                                <div class="ms-3">
                                    <span class="skill-title">{{ $user->experience }}+ Year Job</span>
                                    <p class="mb-0 skill-text">Experience</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(!empty($user->project))
                    <div class="col-xl-3 col-lg-4 mb-xl-0 mb-3">
                        <div class="card border-0 skill-card">
                            <div class="card-body d-flex align-items-center">
                                <div class="skill-icon d-flex justify-content-center align-items-center">
                                    <img src="{{asset('assets/img/vector.png')}}" class="vector-img">
                                </div>
                                <div class="ms-3">
                                    <span class="skill-title">{{ $user->project  }}+ Projects</span>
                                    <p class="mb-0 skill-text">Completed</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(!empty($user->support))
                    <div class="col-xl-3 col-lg-4 mb-xl-0 mb-3">
                        <div class="card border-0 skill-card">
                            <div class="card-body d-flex align-items-center">
                                <div class="skill-icon d-flex justify-content-center align-items-center">
                                    <img src="{{asset('assets/img/headphone.png')}}" class="headphone-img">
                                </div>
                                <div class="ms-3">
                                    <span class="skill-title">Support</span>
                                    <p class="mb-0 skill-text">{{ $user->support }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif

