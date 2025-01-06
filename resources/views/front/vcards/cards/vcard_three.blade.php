@extends('layouts.vcards.app')
@section('title')
    {{ $vcard->name }}
@endsection
@section('page_css')
    <link href="{{ asset('assets/css/web/vcards/vcards-three.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="container p-0">
        <div class="vcard-page-content position-relative">
            {!! QrCode::size(100)->generate(url('p'.DIRECTORY_SEPARATOR.$data['user']->user_name)); !!}

            <div>
                <img src="{{ !empty($vcard->cover_image) ? $vcard->cover_image :  asset('assets/web/css/images/card_three.jpeg') }}"
                     class="vcard-page-banner vcard_bg_cover_three">
            </div>
            <div class="admin_wrapper_card d-flex justify-content-center">
                <div class="admin_card position-relative d-flex flex-sm-row flex-column align-items-center">
                    <div class="d-flex justify-content-center admin-card-image">
                        <img class="rounded-circle vcard_card_three_thumb "
                             src="{{ !empty($vcard->profile_image) ? $vcard->profile_image :  $data['user']->profile_image }}"
                             alt="Thumb">
                    </div>
                    <div class="content px-sm-3 px-0 py-3 w-100">
                        <div class="admin-title pb-3 mb-3">
                            <h5 class="mb-2 text-white text-sm-start text-center">{{ $vcard->name }}</h5>
                            <span class="admin-position text-white d-block mx-sm-0 mx-auto">{{ $vcard->occupation }}</span>
                        </div>
                        <p class="mt-2 mb-0 text-white text-sm-start text-center">
                            {!!  $vcard->introduction !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <div class="row justify-content-center">
                    @if(!empty($data['user']->phone))
                        <div class="col-sm-6 col-6 mt-sm-0 mt-2 d-flex justify-content-center align-items-center px-3">
                            <a class="btn action-phone-button"
                               href="tel: {{ $data['user']->phone }}">
                                <i class="fas fa-mobile-alt"></i>
                                <span class="ms-1">{{ __('messages.phone') }}</span>
                            </a>
                        </div>
                    @endif
                    @if(!empty($data['user']->email))
                        <div class="col-sm-6 col-6 mt-sm-0 mt-2 d-flex justify-content-center align-items-center px-3">
                            <a class="btn action-email-button"
                               href="mailto:{{ $data['user']->email }}">
                                <i class="far fa-envelope"></i>
                                <span class="ms-1">{{ __('messages.email') }}</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <div class="row justify-content-center">
                    <div class="col-sm-6 col-6 mt-sm-0 mt-2 d-flex justify-content-center align-items-center">
                        <a class="btn btn-primary share-vcard"
                           href="javascript:void(0)" data-id="{{$vcard->v_card_unique_id}}">
                            <i class="fas fa-share-square"></i>
                            <span class="ms-1">{{ __('messages.vCards.share_vcard') }}</span>
                        </a>
                    </div>
                </div>
            </div>
            @if(count($vcard->vCardAttributes) > 0)
                <div class="page-info-widget">
                    @forelse($vcard->vCardAttributes as $vcard_attribute)
                        <div class="info-widget d-flex align-items-center">
                            <?php
                            $inStyle = 'style';
                            $style = 'background-color:';
                            ?>
                            <div class="icon-content">
                                <div class="icon vcard-icon-content  "{{$inStyle}}=
                                "{{$style}} {{ ($vcard_attribute->icon_color == '#FFFFFF') || ($vcard_attribute->icon_color == '#00000000') ? '#f5365c' : $vcard_attribute->icon_color}}
                                ;">
                                <i class="{{ $vcard_attribute->icon }} vcard-icon"></i>
                            </div>
                        </div>
                        <div class="icon-link-content-facebook text-break">
                            <span class="icon-link-title-facebook">{{ $vcard_attribute->label_text }}</span>
                            <h5 class="icon-link-facebook mb-0">
                                @if(!is_null($vcard_attribute->value_text))
                                    @if(strpos($vcard_attribute->value_text,'https://') !== false || strpos($vcard_attribute->value_text,'http://') !== false)
                                        <a href="{{$vcard_attribute->value_text}}">{{ $vcard_attribute->value_text }}</a>
                                    @else
                                        <a href="//{{$vcard_attribute->value_text}}">{{ $vcard_attribute->value_text }}</a>
                                    @endif
                                @endif
                            </h5>
                        </div>
                </div>
                @empty
                @endforelse
        </div>
        @endif
        @if(!empty($data['user']->about_me))
            <hr>
            <div class="about-box px-3 mb-3">
                <h3 class="text-dark mb-3">{{ __('messages.about_me') }}</h3>
                <span class="about-me-description text-muted">
                    {!! $data['user']->about_me !!}
                </span>
            </div>
        @endif

        @if(count($data['services']) > 0)
            <hr>
            <h3 class="text-dark mb-3 px-3">{{ __('messages.vCards.our_service') }}</h3>
            <div class="services-sliders">
                @forelse($data['services'] as $service)
                    <div class="row d-flex justify-content-center align-items-start mx-0">
                        <div class="col-12 mr-md-4 mr-0 px-0">
                            <div class="text-center text-lg-left mb-4 mb-lg-0">
                                <div class="services-image text-center position-relative d-inline-block w-100">
                                    <img src="{{$service->icon_image}}" alt="service-icon" class="img-fluid w-100"/>
                                    <h3 class="services-image__name mb-2 custom_test_profile_name">
                                        {{$service->name}}
                                    </h3>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <a type="button" class="btn btn-primary mt-2 service-button"
                                       data-id="{{ $service->id }}">{{ __('messages.vCards.details') }}</a>
                                </div>

                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        @endif
        @if(count($data['testimonials']) > 0)
            <hr>
            <h3 class="text-dark mb-3 px-3">{{ __('messages.vCards.testimonial') }}</h3>
            <div class="testimonial-sliders">
                @forelse($data['testimonials'] as $testimonial)
                    <div class="row d-flex justify-content-center align-items-start mx-0 h-100">
                        <div class="col-12 mr-md-4 mr-0 px-0 h-100">
                            <div class="mb-4 mb-lg-0 card h-100 p-sm-4 p-2">
                                <div class="text-center position-relative d-flex align-items-center w-100 mb-3">
                                    <div class="testimonial-image-container">
                                        <img src="{{$testimonial->image_url}}" alt="service-icon"
                                             class="img-fluid rounded-circle"/>
                                    </div>
                                    <div class="ms-4">
                                        <h3 class="mb-2 custom_test_profile_name">
                                            {{$testimonial->name}}
                                        </h3>
                                        <span class="mt-3 text-left">
                                            {{$testimonial->position}}
                                        </span>
                                    </div>
                                </div>
                                <span class="text-start">
                                    {{$testimonial->description}}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        @endif
        @if(getLoggedInUser() == null)
            <hr>
            <div class="about-box px-3 mb-3">
                <h3 class="text-dark mb-3 px-3">{{ __('messages.contact_us') }}</h3>
                <span class="about-me-description text-muted">
                    {!! getAdminSettingValue('contact_us') !!}
            </span>
                <div class="d-flex justify-content-center">
                    <a type="button" href="{{ url('p'.DIRECTORY_SEPARATOR.$data['user']->user_name) }}/#contact"
                       target="_blank" class="btn btn-primary mt-2">{{ __('messages.contact_us') }}</a>
                </div>

            </div>
        @endif
    </div>
    </div>
@endsection
