<div class="row">
    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
        <p class="copyright__content mb-0">
            All rights reserved &copy; {{ date('Y') }}
            <a class="text-decoration-none pl-1" href="{{$adminSettings['website']}}"
               target="_blank">{{$adminSettings['company_name']}}</a>
        </p>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
        <p class="copyright__content mb-0">
            <a class="text-decoration-none pl-1" href="{{ route('terms.conditions') }}" target="_blank">
                {{ __('messages.terms_conditions') }}
            </a>
            <a class="text-decoration-none pl-3" href="{{ route('privacy.policy') }}" target="_blank">
                {{ __('messages.privacy_policy') }}
            </a>
        </p>
    </div>
</div>
