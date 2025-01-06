<div class="row details-page">
    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('first_name', __('messages.admin_users.first_name').':') }}
        <p>{{ $user->first_name }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('last_name', __('messages.admin_users.last_name').':') }}
        <p>{{ $user->last_name }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('user_name', __('messages.admin_users.user_name').':') }}
        <p>{{ $user->user_name }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('email', __('messages.admin_users.email').':') }}
        <p>{{ $user->email }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('phone', __('messages.admin_users.phone').':') }}
        <p>
            @if($user->phone != null)
                {{ $user->region_code !== null ? '+'.$user->region_code.' '.$user->phone : $user->phone }}
            @else
                {{ __('messages.n/a') }}
            @endif
        </p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('dob', __('messages.admin_users.dob').':') }}
        <p>
            <span>{{ $user->dob !== null ? \Carbon\Carbon::parse($user->dob)->format('jS M, Y') : __('messages.n/a')}}</span>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('experience', __('messages.admin_users.experience').':') }}
        <p>{{ $user->experience !== null ? $user->experience : __('messages.n/a') }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('job_title', __('messages.admin_users.job_title').':') }}
        <p>{{ $user->job_title !== null ? $user->job_title : __('messages.n/a') }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('country', __('messages.admin_users.country').':') }}
        <p>{{ $user->country_id !== null ? $user->country->name : __('messages.n/a') }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('state', __('messages.admin_users.state').':') }}
        <p>{{ $user->state_id !== null ? $user->state->name : __('messages.n/a') }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('city', __('messages.admin_users.city').':') }}
        <p>{{ $user->city_id !== null ? $user->city->name : __('messages.n/a') }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('language', __('messages.admin_users.language').':') }}
        <p>{{ \App\Models\User::LANGUAGES[$user->language] }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('created_at', __('messages.created_on').':') }}
        <p><span data-toggle="tooltip" data-placement="right"
                 title="{{ date('jS M, Y', strtotime($user->created_at)) }}">{{ $user->created_at->diffForHumans() }}</span>
        </p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('updated_at', __('messages.last_updated').':') }}
        <p><span data-toggle="tooltip" data-placement="right"
                 title="{{ date('jS M, Y', strtotime($user->updated_at)) }}">{{ $user->updated_at->diffForHumans() }}</span>
        </p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('profile', __('messages.admin_users.profile').':') }}
        <div class="w-auto mt-2 pl-sm-0 pl-3">
            <img class="img-thumbnail thumbnail-preview" src="{{ $user->profile_image }}">
        </div>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('status', __('messages.blogs_category.status').':') }}
        <p>{{ \App\Models\User::STATUS[$user->status] }}</p>
    </div>

    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
        {{ Form::label('about_me', __('messages.admin_users.about_me').':') }}
        <p>{{ $user->about_me !== null ? html_entity_decode($user->about_me) : __('messages.n/a') }}</p>
    </div>
</div>
