<div class="contact-section py-5 active-header" id="contactUs">
    <div class="testimonial-heading text-center mb-5">
        <h1 class="mb-2">Contact Us</h1>
    </div>
    <div class="container">
        <form class="contact-form pt-3 mb-0" id="sendEnquiryForm">
            <div class="row d-flex justify-content-center contact-responsive">
                <div class="col-lg-6 col-12">
                    @csrf
                    <div class="row g-3 mb-lg-0 mb-4">

                        <div class="col-md-6">
                            <input type="text" name="first_name" class="form-control" placeholder="First Name"
                                   required="">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="last_name" class="form-control" placeholder="Last Name"
                                   required="">
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="email" class="form-control" placeholder="Email Address"
                                   required="">
                        </div>
                        <div class="form-group col-md-6">
                            <div class="d-flex">
                                <div class="region-code dropdown">
                                    <button type="button" class="btn btn-default f16 mr-0 region-code-button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown">
                                        <span class="flag in" id="btnFlag"></span>
                                        <span class="btn-cc">&nbsp;&nbsp;+91&nbsp;&nbsp;</span>
                                        <span class="caretButton"></span>
                                    </button>
                                    {{--                                    <div class="region-code-div dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
                                    <ul class="f16  region-code-ul dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <div class="region-code-ul-input-div"><input type="text"
                                                                                     class="form-control search-country"/>
                                        </div>
                                        <div class="region-code-ul-div"></div>
                                    </ul>
                                    {{--                                    </div>--}}
                                </div>
                                <input type="tel" class="form-control" name="phone" id="phoneNumber"
                                       onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')"
                                       maxlength="10" required/>
                                <input type="hidden" name="region_code" id="regionCode" value="91"/>
                                {{--                                <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>--}}
                                {{--                                <span id="error-msg" class="hide"></span>--}}
                            </div>
                        </div>
                        <div class="col-12">
                            <textarea name="message" placeholder="Message" class="form-control contact-area"
                                      id="exampleFormControlTextarea1" rows="6"></textarea>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-12">
                    <div class="d-flex align-items-center">
                        <div class="contact-icon d-flex justify-content-center align-items-center border-right">
                            <img src="{{asset('assets/img/call1.png')}}" class="call-img">
                        </div>
                        <div class="ms-3">
                            <span class="contact-title">Call Me</span>
                            <p class="mb-0 contact-no">
                                <a class="text-dark text-decoration-none"
                                   href="tel:{{ '+'.getSettingValue('region_code').' '.getSettingValue('phone') }}">
                                    {{ '+'.getSettingValue('region_code').' '.getSettingValue('phone') }}
                                </a></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-4">
                        <div class="contact-icon d-flex justify-content-center align-items-center border-right">
                            <img src="{{asset('assets/img/email1.png')}}" class="mail-img">
                        </div>
                        <div class="ms-3">
                            <span class="contact-title">E-Mail</span>
                            <p class="mb-0 contact-no">
                                <a class="text-dark text-decoration-none text-break"
                                   href="mailto:{{strtolower(getSettingValue('company_email'))}}">
                                    {{ strtolower(getSettingValue('company_email')) }}
                                </a></p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-4">
                        <div class="contact-icon d-flex justify-content-center align-items-center border-right">
                            <img src="{{asset('assets/img/location.png')}}" class="location-img">
                        </div>
                        <div class="ms-3">
                            <span class="contact-title">Location</span>
                            <p class="mb-0 contact-no">{{getSettingValue('address')}}</p>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <div class="my-2">
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                    </div>
                    <button type="submit"
                            class="btn  contact-btn btn-lg"
                            id="enquiryBtn"
                            data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">
                        Send Message
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
