@role('admin')
<li class="nav-item side-menus {{Request::is('users*')?'active':''}}">
    <a class="nav-link" href="{{route('users.edit',Auth::id())}}">
        <i class="fas fa-user big_size_icon  {{checkRequest('users*')?'text-white':'text-orange'}}"></i>
        <span class="nav-link-text custom_disabled_span ">{{__('messages.profile')}}</span>
    </a>
</li>
@endrole
@role('admin')
<li class="nav-item side-menus {{Request::is('experiences*')?'active':''}}">
    <a class="nav-link" href="{{route('experiences.index')}}">
        <i class="fas fa-star big_size_icon  {{checkRequest('experiences*')?'text-white':'text-info'}}"></i>
        <span class="nav-link-text custom_disabled_span ">{{ __('messages.experiences') }}</span>
    </a>
</li>
@endrole
@role('admin')
<li class="nav-item side-menus {{Request::is('educations*')?'active':''}}">
    <a class="nav-link" href="{{route('educations.index')}}">
        <i class="fas fa-graduation-cap big_size_icon  {{checkRequest('educations*')?'text-white':'text-yellow'}} "></i>
        <span class="nav-link-text custom_disabled_span">{{__('messages.education')}}</span>
    </a>
</li>
@endrole
@role('admin')
<li class="nav-item side-menus {{Request::is('vcards*')?'active':''}}">
    <a class="nav-link" href="{{route('vcards.index')}}">
        <i class="fas fa-vr-cardboard" big_size_icon {{checkRequest('vcards*')?'text-white':'text-greens'}} "></i>
        <span class="nav-link-text custom_disabled_span">{{__('messages.vCards.VCards')}}</span>
    </a>
</li>
@endrole
@role('admin')
<li class="nav-item side-menus">
    <a class="nav-link" href="#followers" data-toggle="collapse" aria-expanded="false">
        <i class="fas fa-user-friends text-indigo big_size_icon "></i>
        <span class="custom_disabled_span">{{__('messages.followers.follower_following')}}</span>
    </a>
    <ul class="collapse side-menus list-unstyled sidebar-dropdown" id="followers">
        <ul class="nav">
            <li class="nav-item side-menus nav-item-width {{Request::is('followers*')?'active':''}}">
                <a class="nav-link custom_pl" href="{{route('followers.index')}}">
                    <i class="fas fa-briefcase {{checkRequest('followers*')?'text-white':'text-orange'}} sidebar-menu-category-color"
                       aria-hidden="true"></i> <span>{{__('messages.followers.followers')}}</span>
                </a>
            </li>
            <li class="nav-item side-menus nav-item-width {{Request::is('following*')?'active':''}}">
                <a class="nav-link custom_pl" href="{{route('following.index')}}">
                    <i class="fab fa-weebly {{checkRequest('following*')?'text-white':'text-muted'}} side bar-menu-blog-color"
                       aria-hidden="true"></i><span>{{__('messages.followers.following')}}</span>
                </a>
            </li>
        </ul>
    </ul>
</li>
@endrole
@role('admin')
<li class="nav-item side-menus {{Request::is('qrcode*')?'active':''}}">
    <a class="nav-link" href="{{route('qrcodes.index')}}">
        <i class="fas fa-qrcode big_size_icon  {{checkRequest('qrcode*')?'text-white':'text-dark'}} "></i>
        <span class="nav-link-text custom_disabled_span">{{ __('messages.qr_codes') }}</span>
    </a>
</li>
@endrole
@role('admin')
<li class="nav-item side-menus {{Request::is('skills*')?'active':''}}">
    <a class="nav-link" href="{{route('skills.index')}}">
        <i class="fas fa-clipboard-list big_size_icon  {{checkRequest('skills*')?'text-white':'text-dark'}} "></i>
        <span class="nav-link-text custom_disabled_span">{{ __('messages.skills') }}</span>
    </a>
</li>
@endrole
@role('admin')
<li class="nav-item side-menus {{Request::is('testimonials*')?'active':''}}">
    <a class="nav-link" href="{{route('testimonials.index')}}">
        <i class="fas fa-sticky-note big_size_icon  {{checkRequest('testimonials*')?'text-white':'text-purple'}} "></i>
        <span class="nav-link-text custom_disabled_span">{{ __('messages.testimonials') }}</span>
    </a>
</li>
@endrole
@role('admin')
<li class="nav-item side-menus">
    <a class="nav-link" href="#pricingPlan" data-toggle="collapse" aria-expanded="false">
        <i class="fas fa-hand-holding-usd big_size_icon big_size_icon custom-price-plan-icon-color"></i>
        <span class="custom_disabled_span">{{__('messages.pricing_plans')}}</span>
    </a>
    <ul class="collapse side-menus list-unstyled sidebar-dropdown" id="pricingPlan">
        <ul class="nav">
            <li class="nav-item side-menus nav-item-width {{Request::is('pricing-plans*')?'active':''}}">
                <a class="nav-link custom_pl" href="{{route('pricing-plans.index')}}">
                    <i class="fas fa-hands {{checkRequest('pricing-plans*')?'text-white':'text-pink'}} "></i>
                    <span class="nav-link-text"> {{ __('messages.pricing_plan_currency.plans') }}</span>
                </a>
            </li>
            <li class="nav-item side-menus nav-item-width {{Request::is('plan-currencies*')?'active':''}}">
                <a class="nav-link custom_pl" href="{{route('plan-currencies.index')}}">
                    <i class="fas fa-money-bill-wave {{checkRequest('plan-currencies*')?'text-white':'text-currency-color'}} "></i>
                    <span class="nav-link-text"> {{ __('messages.pricing_plan_currency.plan_currencies') }}</span>
                </a>
            </li>
        </ul>
    </ul>
</li>
@endrole
@role('admin')
<li class="nav-item side-menus">
    <a class="nav-link" href="#recentWork" data-toggle="collapse" aria-expanded="false">
        <i class="fas fa-layer-group text-indigo big_size_icon "></i>
        <span class="custom_disabled_span">{{__('messages.recent_works')}}</span>
    </a>
    <ul class="collapse side-menus list-unstyled sidebar-dropdown" id="recentWork">
        <ul class="nav">
            <li class="nav-item side-menus nav-item-width {{Request::is('recent-work-types*')?'active':''}}">
                <a class="nav-link custom_pl" href="{{route('recent-work-types.index')}}">
                    <i class="fas fa-briefcase {{checkRequest('recent-work-types*')?'text-white':'text-orange'}} sidebar-menu-category-color"
                       aria-hidden="true"></i> <span>{{__('messages.work_types')}}</span>
                </a>
            </li>
            <li class="nav-item side-menus nav-item-width {{Request::is('recent-works*')?'active':''}}">
                <a class="nav-link custom_pl" href="{{route('recent-works.index')}}">
                    <i class="fab fa-weebly {{checkRequest('recent-works*')?'text-white':'text-muted'}} side bar-menu-blog-color"
                       aria-hidden="true"></i><span>{{__('messages.works')}}</span>
                </a>
            </li>
        </ul>
    </ul>
</li>
@endrole
@role('admin')
<li class="nav-item side-menus {{Request::is('services*')?'active':''}}">
    <a class="nav-link" href="{{route('services.index')}}">
        <i class="fas fa-wrench big_size_icon  {{checkRequest('services*')?'text-white':'text-green'}} "></i>
        <span class="nav-link-text custom_disabled_span">{{__('messages.services')}}</span>
    </a>
</li>
@endrole
@role('admin')
<li class="nav-item side-menus {{Request::is('achievement*')?'active':''}}">
    <a class="nav-link" href="{{route('achievements.index')}}">
        <i class="fas fa-trophy big_size_icon   {{checkRequest('achievement*')?'text-white':'text-dark-brown'}}"></i>
        <span class="nav-link-text custom_disabled_span">{{__('messages.achievements')}}</span>
    </a>
</li>
@endrole
@role('admin')
<li class="nav-item side-menus {{Request::is('enquiries*')?'active':''}}">
    <a class="nav-link" href="{{route('enquiries.index')}}">
        <i class="fas fas fa-question-circle big_size_icon  {{checkRequest('enquiries*')?'text-white':''}}"></i>
        <span class="nav-link-text custom_disabled_span">{{__('messages.enquires')}}</span>
    </a>
</li>
@endrole
@role('admin')
<li class="nav-item side-menus {{Request::is('hire-me*')?'active':''}}">
    <a class="nav-link" href="{{route('hire-me.index')}}">
        <i class="fab fa-hire-a-helper big_size_icon  {{checkRequest('hire-me*')?'text-white':'text-dark-green'}} "></i>
        <span class="nav-link-text custom_disabled_span">{{__('messages.hire_requests')}}</span>
    </a>
</li>
@endrole
@role('admin')
<li class="nav-item side-menus">
    <a class="nav-link" href="#blogCategories" data-toggle="collapse" aria-expanded="false">
        <i class="fab fa-blogger-b text-default big_size_icon "></i>
        <span class="custom_disabled_span">{{__('messages.blogs')}}</span>
    </a>
    <ul class="collapse side-menus list-unstyled sidebar-dropdown" id="blogCategories">
        <ul class="nav">
            <li class="nav-item side-menus nav-item-width {{Request::is('categories*')?'active':''}}">
                <a class="nav-link custom_pl" href="{{route('categories.index')}}">
                    <i class="far fa-list-alt {{checkRequest('categories*')?'text-white':'sidebar-menu-category-color'}} "
                       aria-hidden="true"></i> <span> {{__('messages.categories')}}</span>
                </a>
            </li>
            <li class="nav-item side-menus nav-item-width {{Request::is('blogs*')?'active':''}}">
                <a class="nav-link custom_pl" href="{{route('blogs.index')}}">
                    <i class="fas fa-blog {{checkRequest('blogs*')?'text-white':'side bar-menu-blog-color'}} "
                       aria-hidden="true"></i> <span>{{__('messages.blogs_category.posts')}}</span>
                </a>
            </li>
        </ul>
    </ul>
</li>
@endrole
@role('admin')
<li class="nav-item side-menus {{Request::is('settings*')?'active':''}}">
    <a class="nav-link" href="{{route('settings.index')}}">
        <i class="fas fa-cog big_size_icon  {{checkRequest('settings*')?'text-white':'sidebar-menu-setting-color'}} "></i>
        <span class="nav-link-text custom_disabled_span">{{__('messages.settings')}}</span>
    </a>
</li>
@endrole

@role('super_admin')
<li class="nav-item side-menus {{ Request::is('admin/dashboard*') ? 'active':''}}">
    <a class="nav-link" href="{{route('dashboard')}}">
        <i class="fas fa-tachometer-alt big_size_icon  {{checkRequest('admin/dashboard*')?'text-white':'text-success'}} "></i>
        <span class="nav-link-text custom_disabled_span">{{__('messages.dashboard.dashboard')}}</span>
    </a>
</li>
<li class="nav-item side-menus {{ Request::is('admin/users*') || Request::is('admin/user*') ? 'active':''}}">
    <a class="nav-link" href="{{route('users.index')}}">
        <i class="fas fa-users big_size_icon  {{checkRequest('admin/users*')?'text-white':'text-dark'}} "></i>
        <span class="nav-link-text custom_disabled_span">{{__('messages.admin_users.users')}}</span>
    </a>
</li>
<li class="nav-item side-menus">
    <a class="nav-link" href="#address" data-toggle="collapse" aria-expanded="false">
        <i class="fas fa-address-card text-default big_size_icon address-color"></i>
        <span class="custom_disabled_span">{{__('messages.address')}}</span>
    </a>
    <ul class="collapse side-menus list-unstyled sidebar-dropdown" id="address">
        <ul class="nav">
            <li class="nav-item side-menus nav-item-width {{ Request::is('admin/countries*') ? 'active':''}}">
                <a class="nav-link custom_pl" href="{{route('countries.index')}}">
                    <i class="fas fa-globe-americas big_size_icon  {{checkRequest('admin/countries*')?'text-white':'text-info'}} "></i>
                    <span class="nav-link-text">{{__('messages.countries.countries')}}</span>
                </a>
            </li>
            <li class="nav-item side-menus nav-item-width {{ Request::is('admin/states*') ? 'active':''}}">
                <a class="nav-link custom_pl" href="{{route('states.index')}}">
                    <i class="fas fa-flag big_size_icon  {{checkRequest('admin/states*')?'text-white':'state-text-color'}} "></i>
                    <span class="nav-link-text ">{{__('messages.states.states')}}</span>
                </a>
            </li>
            <li class="nav-item side-menus nav-item-width {{ Request::is('admin/cities*') ? 'active':''}}">
                <a class="nav-link custom_pl" href="{{route('cities.index')}}">
                    <i class="fas fa-city big_size_icon  {{checkRequest('admin/cities*')?'text-white':'city-text-color'}} "></i>
                    <span class="nav-link-text">{{__('messages.cities.cities')}}</span>
                </a>
            </li>
        </ul>
    </ul>
</li>
@endrole
@role('super_admin')
<li class="nav-item side-menus {{Request::is('admin/enquiries*')?'active':''}}">
    <a class="nav-link" href="{{route('admin.enquiries.index')}}">
        <i class="fas fas fa-question-circle big_size_icon  {{checkRequest('admin/enquiries*')?'text-white':''}}"></i>
        <span class="nav-link-text custom_disabled_span">{{__('messages.enquires')}}</span>
    </a>
</li>
<li class="nav-item side-menus {{Request::is('admin/subscription-plans*')?'active':''}}">
    <a class="nav-link" href="{{ route('subscription.plans.index') }}">
        <i class="fas fas fa-rupee-sign big_size_icon {{checkRequest('admin/subscription-plans*')?'text-white':''}}"></i>
        <span class="nav-link-text custom_disabled_span">{{ __('messages.subscription_plan') }}</span>
    </a>
</li>
<li class="nav-item side-menus">
    <a class="nav-link" href="#frontCMS" data-toggle="collapse" aria-expanded="false">
        <i class="fab fa-foursquare text-default big_size_icon "></i>
        <span class="custom_disabled_span">{{__('messages.front_cms')}}</span>
    </a>
    <ul class="collapse side-menus list-unstyled sidebar-dropdown" id="frontCMS">
        <ul class="nav">
            <li class="nav-item side-menus nav-item-width {{Request::is('admin/section-one*')?'active':''}}">
                <a class="nav-link custom_pl" href="{{route('cms.section.one.index')}}">
                    <i class="fab fa-stripe-s section-one-color {{checkRequest('admin/section-one*')?'text-white':'sidebar-menu-category-color'}} "
                       aria-hidden="true"></i> <span> {{__('messages.front_side_cms.section_one')}}</span>
                </a>
            </li>
            <li class="nav-item side-menus nav-item-width {{Request::is('admin/section-two*')?'active':''}}">
                <a class="nav-link custom_pl" href="{{route('cms.section.two.index')}}">
                    <i class="fab fa-stripe-s section-two-color {{checkRequest('admin/section-two*')?'text-white':'sidebar-menu-category-color'}} "
                       aria-hidden="true"></i> <span> {{__('messages.front_side_cms.section_two')}}</span>
                </a>
            </li>
            <li class="nav-item side-menus nav-item-width {{Request::is('admin/section-three*')?'active':''}}">
                <a class="nav-link custom_pl" href="{{route('section-three.index')}}">
                    <i class="fab fa-stripe-s section-three-color {{checkRequest('admin/section-three*')?'text-white':'sidebar-menu-category-color'}} "
                       aria-hidden="true"></i> <span> {{__('messages.front_side_cms.section_three')}}</span>
                </a>
            </li>
            <li class="nav-item side-menus nav-item-width {{Request::is('admin/section-four*')?'active':''}}">
                <a class="nav-link custom_pl" href="{{route('section-four.index')}}">
                    <i class="fab fa-stripe-s section-four-color {{checkRequest('admin/section-four*')?'text-white':'sidebar-menu-category-color'}} "
                       aria-hidden="true"></i> <span> {{__('messages.front_side_cms.section_four')}}</span>
                </a>
            </li>
            <li class="nav-item side-menus nav-item-width {{Request::is('admin/section-five*')?'active':''}}">
                <a class="nav-link custom_pl" href="{{route('section-five.index')}}">
                    <i class="fab fa-stripe-s section-five-color {{checkRequest('admin/section-five*')?'text-white':'sidebar-menu-category-color'}} "
                       aria-hidden="true"></i> <span> {{__('messages.front_side_cms.section_five')}}</span>
                </a>
            </li>
        </ul>
    </ul>
</li>
@endrole
@role('super_admin')
<li class="nav-item side-menus {{Request::is('admin/featured-portfolio*')?'active':''}}">
    <a class="nav-link" href="{{route('featured.portfolio.index')}}">
        <i class="far fa-list-alt big_size_icon  {{checkRequest('admin/featured.portfolio.index*')?'text-white':'sidebar-menu-featured-portfolio-color'}} "></i>
        <span class="nav-link-text custom_disabled_span">{{__('messages.featured_portfolio.portfolio')}}</span>
    </a>
</li>
@endrole
@role('super_admin')
<li class="nav-item side-menus {{Request::is('admin/settings*')?'active':''}}">
    <a class="nav-link" href="{{route('admin.settings.index')}}">
        <i class="fas fa-cog big_size_icon  {{checkRequest('admin/settings*')?'text-white':'sidebar-menu-setting-color'}} "></i>
        <span class="nav-link-text custom_disabled_span">{{__('messages.settings')}}</span>
    </a>
</li>

@endrole
