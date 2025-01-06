<footer id="footer" class="border-0 frt-footer-bg">
    <div class="container">
        <div class="footer-widgets-wrap pb-3 m-0">
            <div class="row justify-content-between">
                <div class="col-xl-4 col-md-6">
                    <div class="widget">
                        <?php
                            $inStyle = 'style=';
                            $style= 'top:3px';
                        ?>
                        <h3 class="h1 mb-5">{{$sectionSix['s6_text_title']}}</h3>
                        <span class="text-black-50">{{$sectionSix['s6_text_secondary']}}</span>
                        <a href="mailto:{{$generalSettings['company_email']}}"
                           class="h4 text-dark mt-5 mb-4 d-block"><u>{{$generalSettings['company_email']}}</u> <i
                                    class="icon-line-arrow-right position-relative ms-2" {{$inStyle}}{{$style}}></i></a>
                        <div class="icon-container mt-5">

                            @foreach($socialSettings as $socialSetting => $value)
                                @if(!is_null($value))
                                    @if(strpos($value,'https://') !== false || strpos($value,'http://') !== false)
                                        <a href="{{$value}}" class="social-iocon-container in-{{$loop->iteration}}" target="_blank">
                                            <i class="visble-icon {{$socialSetting}}"></i>
                                            <i class="invisble-icon {{$socialSetting}}"></i>
                                        </a>
                                    @else
                                        <a href="//{{$value}}" class="social-iocon-container in-{{$loop->iteration}}" target="_blank">
                                            <i class="visble-icon {{$socialSetting}}"></i>
                                            <i class="invisble-icon {{$socialSetting}}"></i>
                                        </a>    
                                    @endif
                                    @else
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-xl-5 col-md-6 mt-md-0 mt-5">
                    <h3 class="h1 mb-5">Contact Us</h3>
                    <form class="row mb-0" id="sendEnquiryForm">
                        @csrf
                        <div class="col-sm-6 col-12 form-group mb-4">
                            <input type="text" name="first_name" id="firstName" class="form-control border-form-control"
                                   placeholder="First Name" value="" required/>
                        </div>
                        <div class="col-sm-6 col-12 form-group mb-4">
                            <input type="text" name="last_name" id="lastName" class="form-control border-form-control"
                                   placeholder="Last Name" value="" required/>
                        </div>
                        <div class="col-sm-6 col-12 form-group mb-4">
                            <input type="email" name="email" id="email" class="form-control border-form-control"
                                   placeholder="Email Address" value="" required/>
                        </div>
                        <div class="col-sm-6 col-12 form-group mb-4">
                            <span class="d-flex">
                                <h4 class="font-weight-light d-flex align-items-center my-0">+</h4>
                                <input type="text" name="region_code"
                                       class="form-control border-form-control w-25 text-center"
                                       value="{{ $adminSettings['default_region_code'] }}" id="regionCode"
                                       maxlength="3"
                                       onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                       required/>
                                <input type="text" name="phone" id="phone" class="form-control border-form-control"
                                       placeholder="Phone"
                                       value="" maxlength="10"
                                       onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                       required/>
                            </span>
                        </div>
                        <div class="col-12 form-group mb-4">
                            <textarea id="message" class="form-control border-form-control contact-textarea-size"
                                      placeholder="Message" name="message" cols="10" rows="20" required></textarea>
                        </div>
                        <div class="col-12 custom-captcha">
                            {!! NoCaptcha::renderJs() !!}
                            {!! NoCaptcha::display() !!}
                        </div>
                        <div class="col-12 mt-3 d-flex justify-content-sm-start justify-content-center">
                            <button type="submit" name="landing-enquiry-submit"
                                    class="button h-translatey-3 bg-dark rounded-pill btnAction">
                                <i class="icon-line-loader icon-spin m-0 d-none"></i>
                                Send
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row py-5 footer-section">
            <div class="col-lg-6 col-md-12 col-sm-12 col-12 d-flex">
                All rights reserved &copy; {{ date('Y') }} &nbsp;
                <a class="text-decoration-underline text-dark" href="{{$adminSettings['website']}}" target="_blank">
                    {{$adminSettings['company_name']}}
                </a>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 col-12 d-flex justify-content-end">
                <a class="text-decoration-underline text-dark" href="{{ route('terms.conditions') }}">
                    {{ __('messages.terms_conditions') }}
                </a>
                &nbsp;&nbsp;&nbsp;
                <a class="text-decoration-underline text-dark" href="{{ route('privacy.policy') }}">
                    {{ __('messages.privacy_policy') }}
                </a>
            </div>
        </div>
    </div>
</footer>
