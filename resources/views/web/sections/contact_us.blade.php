<!-- contact us section starts  -->
<section class="contact-us padding-top-100 padding-top-md-50 custom-padding-top-25" id="contact">
    <div class="container">
        <div class="first-content text-center">
            <h2 class="first-content__heading position-relative text-uppercase mb-4 custom_heading_tag"
                data-aos="fade-up"
                data-aos-once="true">
                Contact Us
            </h2>
            <p class="first-content__paragraph" data-aos="fade-up" data-aos-once="true">
                {{ html_entity_decode(getSettingValue('contact_us')) }}
            </p>
        </div>
        <div class="contact-us__block">
            <div class="row no-gutters">
                <div class="col-lg-8 contact-left">
                    <h3 class="text-uppercase title mb-4">Send us a Message</h3>
                    <form class="contact-form pt-3 mb-0" id="sendEnquiryForm">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="text" name="first_name" class="form-control" placeholder="First Name"
                                       required/>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name"
                                       required/>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="Email Address"
                                       required/>
                            </div>
                            {{--                                <div class="input-phone"></div>--}}
                            {{--                                <input type="tel" class="form-control" name="phone" id="phoneNumber"--}}
                            {{--                                       onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"--}}
                            {{--                                       required/>--}}
                            {{--                                {{ Form::hidden('region_code',null,['id'=>'prefix_code']) }}--}}
                            <div class="form-group col-md-6">
                                <div class="d-flex">
                                    <div class="region-code">
                                        <button type="button" class="btn btn-default f16 mr-0 region-code-button"
                                                id="dropdownMenuButton" data-toggle="dropdown">
                                            <span class="flag {{ $adminSettings['default_region_code_flag'] }}"
                                                  id="btnFlag"></span>
                                            <span class="btn-cc">&nbsp;&nbsp;+{{ $adminSettings['default_region_code'] }}&nbsp;&nbsp;</span>
                                            <span class="caretButton"></span>
                                        </button>
                                        <div class="region-code-div" aria-labelledby="dropdownMenuButton">
                                            <ul class="f16 dropdown-menu region-code-ul">
                                                <div class="region-code-ul-input-div"><input type="text"
                                                                                             class="form-control search-country"/>
                                                </div>
                                                <div class="region-code-ul-div"></div>
                                            </ul>
                                        </div>
                                    </div>
                                    <input type="tel" class="form-control" name="phone" id="phoneNumber"
                                           onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                           required/>
                                    <input type="hidden" name="region_code" id="regionCode"
                                           value="{{ $adminSettings['default_region_code'] }}"/>
                                    <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>
                                    <span id="error-msg" class="hide"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Message" name="message" required></textarea>
                        </div>
                        <div class="form-group row">
                            <div class="d-flex justify-content-center col-lg-12 custom-captcha">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}
                            </div>
                            <div class="col-lg-12 d-flex justify-content-center pt-3">
                                <button type="submit"
                                        class="btn btn-primary send-msg-btn text-uppercase custom_contact_btn"
                                        id="enquiryBtn"
                                        data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">
                                    Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 contact-info">
                    <img src="{{ asset($adminSettings['company_logo']) }}" class="logo-img" width="75" height="35"
                         alt="">
                    <h3 class="text-uppercase title mb-4 mt-5 text-white">
                        Information
                    </h3>
                    <ul class="mb-0 pt-3">
                        <li class="mb-4 d-flex align-items-center">
                            <i class="fas fa-map-marker-alt text-white pr-2 contact-info__contact-icon"></i>
                            <p class="text-white">
                                {{ $adminSettings['address'] }}
                            </p>
                        </li>
                        <li class="mb-4 d-flex align-items-center">
                            <i class="fas fa-phone-alt text-white pr-2 contact-info__contact-icon"></i>
                            <a class="text-white text-decoration-none" href="tel:{{ '+'.$adminSettings['region_code'].' '.$adminSettings['phone'] }}">
                                {{ '+'.$adminSettings['region_code'].' '.$adminSettings['phone'] }}
                            </a>
                        </li>
                        <li class="mb-4 d-flex align-items-center">
                            <i class="fas fa-envelope text-white pr-2 contact-info__contact-icon"></i>
                            <a class="text-white text-decoration-none text-break"
                               href="mailto:{{strtolower($adminSettings['company_email'])}}">
                                {{ strtolower($adminSettings['company_email']) }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
