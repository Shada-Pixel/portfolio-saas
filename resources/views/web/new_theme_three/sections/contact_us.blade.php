{{--contact us--}}

<div class="contact-section py-sm-5 py-3 active-link-class" id="contactUs">

    <div class="container">
        <div class="row d-flex justify-content-center contact-responsive">
            <div class="col-lg-6 col-12 contact-info">
                <div class="mb-5">
                    <h1 class="mb-2">Get in Touch</h1>
                    <p class="contact-text">
                        {{ html_entity_decode($adminSettings['contact_us']) }}
                    </p>
                </div>
                <div class="d-flex align-items-center contact-details">
                    <div class="contact-icon d-flex justify-content-center align-items-center border-right mb-sm-0 mb-2">
                        <img src="{{asset('assets/img/call1.png')}}" class="call-img">
                    </div>
                    <div class="ms-sm-3 text-center">
                        <a class="text-dark text-decoration-none contact-title"
                           href="tel:{{ '+'.$adminSettings['region_code'].' '.$adminSettings['phone'] }}">
                            {{ '+'.$adminSettings['region_code'].' '.$adminSettings['phone'] }}
                        </a>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-4 contact-details">
                    <div class="contact-icon d-flex justify-content-center align-items-center border-right mb-sm-0 mb-2">
                        <img src="{{asset('assets/img/email1.png')}}" class="mail-img">
                    </div>
                    <div class="ms-sm-3 text-center">
                        <a class="text-dark text-decoration-none text-break contact-title"
                           href="mailto:{{strtolower($adminSettings['company_email'])}}">
                            {{ strtolower($adminSettings['company_email']) }}
                        </a>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-4 contact-details">
                    <div class="contact-icon d-flex justify-content-center align-items-center border-right mb-sm-0 mb-2">
                        <img src="{{asset('assets/img/location.png')}}" class="location-img">
                    </div>
                    <div class="ms-sm-3 text-center">
                        <span class="contact-title">{{$adminSettings['address']}}</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-12 mt-5">
                <form class="contact-form pt-3 mb-0" id="sendEnquiryForm">
                    @csrf
                    <div class="content-box">
                        <div class="row g-3 mb-lg-0 mb-4">
                            <div class="col-xl-6 col-lg-12 col-md-6">
                                <input type="text" name="first_name" class="form-control" placeholder="First Name"
                                       required="">
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-6">
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name"
                                       required="">
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="Email Address"
                                       required="">
                            </div>
                            <div class="form-group col-xl-6 col-lg-12 col-md-6">
                                <div class="d-flex">
                                    <div class="region-code dropdown">
                                        <button type="button" class="btn btn-default f16 mr-0 region-code-button"
                                                id="dropdownMenuButton" data-bs-toggle="dropdown">
                                            <span class="flag in" id="btnFlag"></span>
                                            <span class="btn-cc">&nbsp;&nbsp;+91&nbsp;&nbsp;</span>
                                            <span class="caretButton"></span>
                                        </button>
                                        {{--                                    <div class="region-code-div dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
                                        <ul class="f16  region-code-ul region-code-div dropdown-menu"
                                            aria-labelledby="dropdownMenuButton">
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
                            <div class="text-end py-3">
                                <div class="my-2">
                                    {!! NoCaptcha::renderJs() !!}
                                    {!! NoCaptcha::display() !!}
                                </div>
                                <button class="btn send-btn mt-3" id="enquiryBtn"
                                        data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">
                                    Send Message
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
