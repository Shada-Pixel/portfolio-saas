<!-- about us section starts -->
@if($aboutMe->count() > 0)
    <section class="about-me padding-top-100 padding-top-md-50" id="achivements">
        <div class="container">
            @if(!empty($user->about_me))
                <div class="first-content text-center">
                    <h2 class="first-content__heading position-relative text-uppercase mb-4 custom_heading_tag custom-about-border"
                        data-aos="fade-up"
                        data-aos-once="true">
                        About Me
                    </h2>
                    <span class="first-content__paragraph about-me-description" data-aos="fade-up"
                          data-aos-once="true">{!! $user->about_me !!}</span>
                </div>
            @endif
            <div class="about-me__block">
                <div class="text-center">
                    <h2 class="first-content-achievement__heading custom_heading_tag position-relative text-uppercase mb-5 custom-mb-2"
                        data-aos="fade-up"
                        data-aos-once="true">
                        Achievements
                    </h2>
                </div>
                <?php
                $inStyle = 'style';
                $stylePar = 'color:';
                ?>
                <div class="row justify-content-center">
                    @forelse($aboutMe as $about)
                        @if($loop->iteration <=4 )
                            <div class="col-lg-3 col-md-6 about-box fadeIn custom_about_box front-animation">
                                <div class="items-box bg-white custom_item_box">
                                    <div class="items-box__icon mb-3">
                                        <i class="{{$about->icon}} about-me-icon-size light-mode-icon" {{$inStyle.'='.$stylePar.$about->color }}></i>
                                        <i class="{{$about->dark_icon}} about-me-icon-size dark-mode-icon d-none" {{$inStyle.'='.$stylePar.$about->color }}></i>
                            </div>
                            <strong class="items-box__numbers">{{$about->title}}</strong>
                            <span class="items-box__name mt-3">{!! $about->short_description  !!}</span>
                        </div>
                    </div>
                    @else
                        <div class="col-lg-3 col-md-6 about-box fadeIn show-about-me mt-4 custom_about_box front-achievement-show-more">
                            <div class="items-box bg-white custom_item_box">
                                <div class="items-box__icon mb-3">
                                    <i class="{{$about->icon}} about-me-icon-size light-mode-icon" {{$inStyle.'='.$stylePar.$about->color }}></i>
                                    <i class="{{$about->dark_icon}} about-me-icon-size dark-mode-icon d-none" {{$inStyle.'='.$stylePar.$about->color }}></i>
                                </div>
                                <strong class="items-box__numbers">{{$about->title}}</strong>
                                <span class="items-box__name mt-3">{!! $about->short_description  !!}</span>
                            </div>
                        </div>
                    @endif
                @empty
                    <h5>Achievement not available</h5>
                @endforelse
                @if($aboutMe->count() > 4)
                        <div class="col-12 text-center mt-4 custom-mt-0">
                            <a href="#/" class="btn show-more-link show-more-link-about-me" data-content="toggle-text">Show
                                More</a>
                        </div>
                    @endif
            </div>
        </div>
    </div>
</section>
@endif
