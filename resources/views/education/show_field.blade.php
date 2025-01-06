<div class="row details-page">
    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('school_name', __('messages.school_name').':') }}
        <p>{{ html_entity_decode($education->school_name) }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('qualification', __('messages.qualification').':') }}
        <p>{{ html_entity_decode($education->qualification) }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('country_id', __('messages.country').':') }}
        <p>{{ html_entity_decode($education->country->name) }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('state_id', __('messages.state').':') }}
        <p>{{ html_entity_decode($education->state->name) }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('city_id', __('messages.city').':') }}
        <p>{{ html_entity_decode($education->city->name) }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('currently_studying_here', __('messages.current_study_here').':') }}
        <p>{{ ($education->currently_studying_here)?'Yes':'No' }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('start_date', __('messages.start_date').':') }}
        <p><span>{{ \Carbon\Carbon::parse($education->start_date)->format('jS M, Y') }}</span>
        </p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('end_date', __('messages.end_date').':') }}
        <p>
            <span>{{  !empty($education->end_date)?\Carbon\Carbon::parse($education->end_date)->format('jS M, Y'):'N/A' }}</span>
        </p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('created_at', __('messages.created_on').':') }}
        <p><span data-toggle="tooltip" data-placement="right"
                 title="{{ date('jS M, Y', strtotime($education->created_at)) }}">{{ $education->created_at->diffForHumans() }}</span>
        </p>
    </div>
    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('updated_at', __('messages.last_updated').':') }}
        <p><span data-toggle="tooltip" data-placement="right"
                 title="{{ date('jS M, Y', strtotime($education->updated_at)) }}">{{ $education->updated_at->diffForHumans() }}</span>
        </p>
    </div>
</div>
