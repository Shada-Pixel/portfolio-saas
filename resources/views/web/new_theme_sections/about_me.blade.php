{{--About Me--}}
<div class="container py-5 about-main active-header" id="aboutMe">
    <div class="row">
        <div class="about-section text-center d-flex justify-content-center align-items-center mt-5">
            <div class="about-content col-lg-7 col-12">
                <h1>About Me</h1>
                <p>{!! $user->about_me !!}</p>
                <div class="about-details d-flex justify-content-center">
                    <ul class="about-responsive">
                        <li class="item d-flex mb-4">
                                <span class="about-data">
                                    <img src="{{asset('assets/img/user.png')}}">
                                    <span class="ms-3 me-sm-5 me-3">Name</span>:
                                </span>
                            <span class="ms-sm-4 ms-0">{{$user->full_name}}</span>
                        </li>
                        <li class="item d-flex mb-4">
                                 <span class="about-data">
                                    <img src="{{asset('assets/img/call.png')}}">
                                    <span class="ms-3 me-sm-5 me-3">Phone</span>:
                                 </span>
                            <span class="ms-sm-4 ms-0">
                                    <a class="text-decoration-none text-dark position-relative"
                                       href="tel:{{$user->phone}}">
                                        @if(isset($user->phone))
                                            {{ '+'.$user->region_code.' '.$user->phone}}
                                        @else
                                            {{ __('messages.n/a') }}
                                        @endif
                                    </a>
                            </span>
                        </li>
                        <li class="item d-flex  mb-4">
                                 <span class="about-data">
                                    <img src="{{asset('assets/img/email.png')}}">
                                    <span class="ms-3 me-sm-5 me-3">E-mail</span>:
                                 </span>
                            <span class="ms-sm-4 ms-0">
                                <a class="text-decoration-none text-dark position-relative"
                                   href="mailto:{{ $user->email }}">
                                    {{$user->email}}
                                </a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@if($aboutMe->count() > 0)
    <div class="achievement-section py-5">
        <div class="achivement-heading text-center mb-5">
            <h1 class="mb-2">Achievement</h1>
        </div>
        <?php
        $inStyle = 'style';
        $stylePar = 'color:';
        ?>
        <div class="d-flex justify-content-center align-items-center container">
            <div class="row d-flex justify-content-center w-100 gx-4 gy-5">
                @forelse($aboutMe as $about)
                    @if($loop->iteration <=4 )
                        <div class="col-lg-3 col-sm-6 mb-xl-0 mb-5">
                            <div class="card achievement">
                                <div class="achiev-icon bg-transparent fa-5x d-flex justify-content-center align-items-center">
                                    {{--                                    <img src="{{asset('assets/img/frame2.png')}}">--}}
                                    <i class="{{$about->icon}} about-me-icon-size light-mode-icon" {{$inStyle.'='.$stylePar.$about->color }}></i>
                                    {{--                                    <i class="{{$about->dark_icon}} about-me-icon-size dark-mode-icon d-none" {{$inStyle.'='.$stylePar.$about->color }}></i>--}}
                                </div>
                                <div class="achievement-box">
                                    <p class="mb-2 achive-title">{{$about->title}}</p>
                                    <p class="achive-info">{!! $about->short_description  !!}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-3 col-sm-6 mb-xl-0 mb-5 mt-5 view-all-about-me">
                            <div class="card achievement">
                                <div class="achiev-icon bg-transparent fa-5x d-flex justify-content-center align-items-center">
                                    {{--                                    <img src="{{asset('assets/img/frame2.png')}}">--}}
                                    <i class="{{$about->icon}} about-me-icon-size light-mode-icon" {{$inStyle.'='.$stylePar.$about->color }}></i>
                                    {{--                                    <i class="{{$about->dark_icon}} about-me-icon-size dark-mode-icon d-none" {{$inStyle.'='.$stylePar.$about->color }}></i>--}}
                                </div>
                                <div class="achievement-box">
                                    <p class="mb-2 achive-title">{{$about->title}}</p>
                                    <p class="achive-info">{!! $about->short_description  !!}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                @empty
                    <h5>Achievement not available</h5>
                @endforelse
            </div>
        </div>
    </div>
    @if($aboutMe->count() > 4)
        <div class="text-center offer-section bg-transparent mb-3">
            <button class="btn offer-btn px-5 view-all-about-me-link">View All</button>
        </div>
    @endif
@endif

