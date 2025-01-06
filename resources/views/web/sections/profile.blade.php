<div name="home">
    <section class="profile-information padding-top-100 padding-top-md-50 text-center" id="profile">
        <img data-src="{{asset('assets/img/ptofile-bg-2.png')}}"  data-value="-5" class="profile-bg-img lazy">
        <div class="container">
            <div data-aos="fade-up" data-aos-duration="800" data-aos-once="true">
                <div>
                    <div class="profile-information__first-image position-relative">
                        <div class="position-relative">
                            <img data-src="{{isset($user->media[0])?$user->profile_image:asset('img/infyom-logo.png')}} "
                                 alt="award-icon"
                                 class="img-fluid mb-3 lazy" width="198px"
                                 height="198px"/>
                        </div>
                    </div>
                    <div class="profile-information__content bg-white">
                        <div class="details text-center">
                            <h1 class="details__name mb-3 custom_profile_heading">{{$user->full_name}}</h1>
                            <span class="details__designation mb-3">{{$user->job_title}}</span>
                            <div class="nav mt-4 row">
                                <div class="col-xl-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-xl-5 col-12">
                                            <div class="social-info text-left">
                                                <a class="text-decoration-none position-relative"
                                                   href="{{ isset($user->phone) ? 'tel:'.$user->phone : '#' }}">
                                                    <i class="fas fa-phone-alt mr-2 custom_phone"></i>
                                                    @if(isset($user->region_code))
                                                        {{ '+'.$user->region_code.' '.$user->phone}}
                                                    @else
                                                        {{ __('messages.n/a') }}
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-12 pl-xl-0">
                                            <div class="social-info text-left">
                                                <a class="text-decoration-none position-relative" href="#">
                                                    <i class="fas fa-map-marker-alt mr-2 custom_city"></i>
                                                    @if(!isset($user->city) && !isset($user->country))
                                                        {{ __('messages.n/a') }}
                                                    @else
                                                        {{ isset($user->city) ? $user->city->name.', ' : __('messages.n/a') }}
                                                        {{ isset($user->country) ? $user->country->name : __('messages.n/a') }}
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-12 pl-xl-0">
                                            <div class="social-info text-left">
                                                <a class="text-decoration-none position-relative" href="#">
                                                    <i class="fas fa-calendar-check mr-2 custom_dob"></i>{{\Carbon\Carbon::parse($user->dob)->age}}
                                                    Year Old
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-6">
                                    <div class="row">
                                        <div class="col-xl-5 col-12">
                                            <div class="social-info text-left">
                                                <a class="text-decoration-none position-relative"
                                                   href="mailto:{{ $user->email }}">
                                                    <i class="fas fa-envelope mr-2 custom_email"></i>{{$user->email}}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-12 pl-xl-0">
                                            <div class="social-info text-left">
                                                <a class="text-decoration-none position-relative"
                                                   href="#">
                                                    <i class="fas fa-briefcase mr-2 custom_exp"></i>
                                                    {{isset($user->experience) ? $user->experience : '0'}}
                                                    Year Experience
                                                </a>
                                            </div>
                                        </div>
                                        @if($user->available_as_freelancer)
                                            <div class="col-xl-3 col-12 pl-xl-0">
                                                <div class="social-info text-left">
                                                    <a class="text-decoration-none position-relative" href="#/">
                                                        <i class="fas fa-check-square mr-2 custom_freelancer"></i>
                                                        Available Freelancer
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @if(getLoggedInUser() == null)
                                <a href="javascript:void(0)" class="btn btn-primary custom-btn mb-4 mt-3"
                                   id="createModel">
                                    Hire Me
                                </a>
                            @endif
                            <ul class="nav justify-content-center align-items-center ml-0 social-link">
                                @if(count($socialSettings) > 0)
                                    @foreach($socialSettings as $socialSetting)
                                        <li class="nav-item mb-0">
                                            @if(!is_null($socialSetting->value))
                                                @if(strpos($socialSetting->value,'https://') !== false || strpos($socialSetting->value,'http://') !== false)
                                                    <a class="nav-link" href="{{$socialSetting->value}}" target="_blank">
                                                        <i class="{{$socialSetting->key}}"></i>
                                                    </a>
                                                @else
                                                    <a class="nav-link" href="//{{$socialSetting->value}}" target="_blank">
                                                        <i class="{{$socialSetting->key}}"></i>
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
            </div>
        </div>
    </section>
</div>
