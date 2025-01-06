@extends('layouts.front.app')
@php
    $adminSettings = $adminSetting->pluck('value','key')->toArray();
@endphp
@section('title')
    {{ $adminSettings['company_name'] }}
@endsection
@section('content')
    <section id="slider" class="slider-element min-vh-md-100 py-4 include-header slider-hero">
        <div class="slider-inner">
            <div class="vertical-middle slider-element-fade">
                <div class="container text-center py-5">
                    <div class="emphasis-title mb-2">
                        <h4 class="text-uppercase ls3 fw-bolder mb-0">{{ $sectionOne['text_title'] }}</h4>
                        <h1>
								<span id="oc-images" class="owl-carousel image-carousel carousel-widget" data-items="1"
                                      data-margin="0" data-autoplay="3000" data-loop="true" data-nav="false"
                                      data-pagi="false" data-animate-in="fadeInUp">
									<div class="oc-item gradient-text gradient-red-yellow text-uppercase">{{ $sectionOne['text_main_one'] }}</div>
									<div class="oc-item gradient-text gradient-red-yellow text-uppercase">{{ $sectionOne['text_main_two'] }}</div>
                                @if($sectionOne['text_main_three'])
                                    <div class="oc-item gradient-text gradient-red-yellow text-uppercase">
                                            {{ $sectionOne['text_main_three'] }}    
                                    </div>
                                @endif
                                 @if($sectionOne['text_main_four'])
                                    <div class="oc-item gradient-text gradient-red-yellow text-uppercase">
                                        {{ $sectionOne['text_main_four'] }}
                                    </div>
                                @endif
                              @if($sectionOne['text_main_five'])
                                <div class="oc-item gradient-text gradient-red-yellow text-uppercase">
                                      {{ $sectionOne['text_main_five'] }}
                                </div>
                              @endif
								</span>
                        </h1>
                    </div>
                    <!-- <div class="d-flex align-items-center justify-content-center mb-5">
                        <img src="demos/freelancer/images/face.svg" alt="Face" width="60">
                        <span class="text-uppercase fw-bold ms-3">SemiColonWeb</span>
                    </div> -->
                        <div class="mx-auto slider-text-secondary">
                           
                            <p class="lead fw-normal text-dark mb-5">
                                {!! $sectionOne['text_secondary'] !!}
                            </p>
                            @if(!\Illuminate\Support\Facades\Auth::check())
                                <a href="{{route('user.register')}}"
                                   class="button button-dark button-hero h-translatey-3 tf-ts button-reveal overflow-visible bg-dark text-end"><span>{{ __('messages.get_started') }}</span><i
                                            class="icon-line-arrow-right"></i></a>
                            @endif
                        </div>
          
                </div>
            </div>
        </div>
    </section>

    <section id="content">
        <div class="content-wrap p-0 section-content">
            <div class="section mb-0 pt-3 pb-0 section-wrapper">
                <div class="shape-divider" data-shape="wave" data-height="150" data-outside="true"
                     data-flip-vertical="true" data-fill="#F4F4F4"></div>
                <div class="container">
                    <div class="row justify-content-center text-center mt-5">
                        <div class="col-lg-6">
                            <div>
                                <h3 class="fw-bolder h1 mb-4">{!! $sectionTwo['s2_text_title'] !!}</h3>
                                <p class="mb-5 lead text-black-50 fw-extralight">
                                    {!! $sectionTwo['s2_text_secondary'] !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center position-relative">
                    <?php
                        $backgroundStyle = 'style';
                        $backgroundTag = 'background-image:';
                    ?>
                    
                    <div class="parallax min-vh-75 section-parallax" data-bottom-top="width: 40vw"
                         data-center-top="width: 100vw;" {{$backgroundStyle}} = "{{$backgroundTag}} url('{{$sectionTwo['s2_background_image']}}')">
                        <div class="row align-items-center justify-content-center h-100">
                            <div class="col-auto text-center">
                                <a href="{{ $sectionTwo['s2_link_one_link'] }}"
                                   class="display-4 fw-bolder text-white d-inline-block mx-4 h-op-08 op-ts"
                                   target="_blank">
                                    <u>{{ $sectionTwo['s2_link_one_text'] }}</u>
                                </a>
                                <a href="{{ $sectionTwo['s2_link_two_link'] }}"
                                   class="display-4 fw-bolder text-white d-inline-block mx-4 h-op-08 op-ts"
                                   target="_blank">
                                    <u>{{ $sectionTwo['s2_link_two_text'] }}</u>
                                </a>
                            </div>
                        </div>
                </div>
                <div class="shape-divider" data-shape="wave" data-position="bottom"></div>
            </div>
        </div>

        <div class="container section-counters">
            <div class="row col-mb-30 mt-5">
                <div class="col-md-4 pb-mb-5 pb-2">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="counter counter-xlarge text-dark fw-bolder"><span data-from="1"
                                                                                      data-to="{{ $sectionTwo['s2_counter_one_value'] }}"
                                                                                          data-refresh-interval="2"
                                                                                          data-speed="600"></span></div>
                            <span>{{ $sectionTwo['s2_counter_one_text'] }}</span>
                    </div>
                </div>

                <div class="col-md-4 pb-mb-5 pb-2">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="counter counter-xlarge text-dark fw-bolder"><span data-from="4"
                                                                                      data-to="{{ $sectionTwo['s2_counter_two_value'] }}"
                                                                                          data-refresh-interval="50"
                                                                                          data-speed="1500"></span>
                            </div>
                            <span>{{ $sectionTwo['s2_counter_two_text'] }}</span>
                    </div>
                </div>

                <div class="col-md-4 pb-mb-5 pb-2">
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="counter counter-xlarge text-dark fw-bolder"><span data-from="5"
                                                                                      data-to="{{ $sectionTwo['s2_counter_three_value'] }}"
                                                                                          data-refresh-interval="30"
                                                                                          data-speed="1200"></span>
                            </div>
                            <span>{{ $sectionTwo['s2_counter_three_text'] }}</span>
                    </div>
                </div>
            </div>
            <div class="line line-sm mb-0"></div>
        </div>

        <div class="section bg-transparent py-0 mb-3">
            <div class="container">
                <div class="row align-items-center justify-content-around">
                    <div class="col-lg-4">
                        <h3 class="fw-bolder h1 mb-4">{{ $sectionThreeFrontCms['s3_text_title'] }}</h3>
                            <div id="oc-testi" class="owl-carousel testimonials-carousel carousel-widget mt-5"
                                 data-margin="0" data-items="1" data-pagi="true" data-nav="false">
                                @foreach($sectionThreeData as $sectionThree)
                                    <div class="oc-item">
                                        <div class="testimonial border-0 shadow-none bg-transparent">
                                            <div class="testi-content">
                                                <p>{!! $sectionThree->slider_text !!}</p>
                                                <div class="testi-meta d-flex align-items-center">
                                                    <img src="{{ $sectionThree->image_url }}" alt="Face"
                                                         width="30">
                                                    <div>
                                                        {{ $sectionThree->image_text }}
                                                        <span class="ps-0">{{ $sectionThree->image_text_secondary }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <div class="col-lg-6">
                            <img src="{{ $sectionThreeFrontCms['s3_image_main'] }}" alt="">
                        </div>
                </div>
            </div>
        </div>

        <div class="clear"></div>

        <div class="section bg-transparent py-0 mb-3">
            <div class="container">
                <div class="row align-items-end mb-5">
                    <div class="col-lg-5 offset-lg-1">
                        <h3 class="fw-bolder h1">{{$sectionFourFrontCms['s4_text_title']}}</h3>
                            <p>{{$sectionFourFrontCms['s4_text_secondary']}}</p>
                    </div>
                </div>

                <div class="row gutter-sm-50 gutter-10 mb-5 align-items-stretch help-section justify-content-center">
                    @forelse($sectionFourData as $sectionFour)
                        <div class="col-lg-4 col-md-6 col-12">
                            <?php
                            $inStyle = 'style';
                            $style = 'background:';
                            ?>
                            <div class="card d-flex flex-column p-sm-4 p-2 border-0 h-100 fix-card" {{$inStyle}}=
                            "{{$style}} {{ ($sectionFour->color == '#FFFFFF') ? '#f5365c' : $sectionFour->color}};">
                            <div class="card-body">
                                <img src="{{ $sectionFour->image_url }}" height="50"
                                     alt="Image" class="mb-4">
                                <h3 class="card-title fw-bolder">{{ $sectionFour->image_text }}</h3>
                                <p class="card-text mb-0 mt-2 fw-light">{!!$sectionFour->image_text_description!!}</p>
                            </div>
                        </div>
                </div>
                @empty
                @endforelse
            </div>
        </div>
        <div class="clear"></div>
        </div>

        <div class="section m-0 faq-section pb-5">
            <div class="shape-divider" data-shape="wave-4" data-height="150" id="shape-divider-6017">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1280 140" preserveAspectRatio="none">
                    <path class="shape-divider-fill" fill="#F8F7F2"
                          d="M0 51.76c36.21-2.25 77.57-3.58 126.42-3.58 320 0 320 57 640 57 271.15 0 312.58-40.91 513.58-53.4V0H0z"
                          opacity="0.3"></path>
                    <path class="shape-divider-fill"
                          d="M0 24.31c43.46-5.69 94.56-9.25 158.42-9.25 320 0 320 89.24 640 89.24 256.13 0 307.28-57.16 481.58-80V0H0z"
                          opacity="0.5"></path>
                    <path class="shape-divider-fill"
                          d="M0 0v3.4C28.2 1.6 59.4.59 94.42.59c320 0 320 84.3 640 84.3 285 0 316.17-66.85 545.58-81.49V0z"></path>
                </svg>
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-5 mt-lg-0 mt-5">
                        <h3 class="fw-bolder h1 my-5">{{$sectionFiveFrontCms['s5_text_title']}}</h3>
                                <div class="accordion" data-collapsible="true">
                                    @forelse($sectionFiveData as $section)
                                        <div class="accordion-header" id="id-accordion-4">
                                            <div class="accordion-icon">
                                                <i class="accordion-closed icon-line-plus color gradient-text gradient-red-yellow"></i>
                                                <i class="accordion-open icon-line-minus color gradient-text gradient-red-yellow"></i>
                                            </div>
                                            <div class="accordion-title">
                                                {{$section->text_main}}
                                            </div>
                                        </div>
                                        <div class="accordion-content">{!!$section->text_secondary!!}
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                        </div>
                        <div class="col-lg-7">
                            <img src="{{$sectionFiveFrontCms['s5_main_image']}}" alt="FAQs" class="px-5">
                        </div>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div>

    </section>
@endsection
