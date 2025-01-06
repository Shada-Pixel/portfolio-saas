{{--About Me--}}

<div class="container about-main active-link-class" id="aboutMe">
    <div class="row">
        <div class="about-section text-center d-flex justify-content-center align-items-center my-sm-5 my-3">
            <div class="about-content col-lg-7 col-12">
                <h1 class="mb-sm-5 mb-3">About Me</h1>
                <p>{!! $user->about_me !!}</p>
                <div class="about-details d-flex justify-content-center">
                    <ul class="about-responsive mt-4 mb-0">
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
                                <a class="text-decoration-none text-dark position-relative" href="tel:{{$user->phone}}">
                                    @if(isset($user->phone))
                                        {{ '+'.$user->region_code.' '.$user->phone}}
                                    @else
                                        {{ __('messages.n/a') }}
                                    @endif
                                </a>
                            </span>
                        </li>
                        <li class="item d-flex mb-3">
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

{{--Achievement section--}}
@if($aboutMe->count() > 0)
    <div class="achievement-section pt-0 pb-5">
        <div class="achivement-heading text-center mb-sm-5 mb-4">
            <h1 class="mb-2">Achievement</h1>
            <?php
            $inStyle = 'style';
            $stylePar = 'color:';
            ?>
        </div>
        <div class="d-flex justify-content-center align-items-center container">
            <div class="row d-flex justify-content-center w-100 g-3 w-100">
                @forelse($aboutMe as $about)
                    @if($loop->iteration <=4 )
                        <div class="col-xl-3 col-lg-6">
                            <div class="card achievement border-0">
                                <div class="card-body d-flex align-items-center p-0 achievement-box">
                                    <div class="achiev-icon d-flex justify-content-center align-items-center px-4">
                                        <i class="{{$about->icon}} about-me-icon-size light-mode-icon" {{$inStyle.'='.$stylePar.$about->color }}></i>
                                    </div>
                                    <div class="ms-3">
                                        <p class="mb-1 achive-title">{{$about->title}}</p>
                                        <p class="achive-info">
                                            {!! $about->short_description  !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-xl-3 col-lg-6 view-all-about-me">
                            <div class="card achievement border-0">
                                <div class="card-body d-flex align-items-center p-0 achievement-box">
                                    <div class="achiev-icon d-flex justify-content-center align-items-center px-4">
                                        <i class="{{$about->icon}} about-me-icon-size light-mode-icon" {{$inStyle.'='.$stylePar.$about->color }}></i>
                                    </div>
                                    <div class="ms-3">
                                        <p class="mb-1 achive-title">{{$about->title}}</p>
                                        <p class="achive-info">
                                            {!! $about->short_description  !!}
                                        </p>
                                    </div>
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
        <div class="text-center offer-section bg-transparent mb-5">
            <button class="btn offer-btn px-5 view-all-about-me-link">View All</button>
        </div>
    @endif
@endif
