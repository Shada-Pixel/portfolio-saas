<div class="{{ Request::is('p/'.$user->user_name) ? 'footer' : '' }} position-relative py-4">
    <p class="text-center mb-0">All rights reserved © {{date('Y')}}
        <a class="text-decoration-none pl-1 footer-link-color" href="{{$adminSettings['website']}}"
           target="_blank">{{$adminSettings['company_name']}}</a>
    </p>
</div>
