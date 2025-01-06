<div class="row details-page">
    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('job_title', __('messages.job_title').':') }}
        <p>{{ html_entity_decode($experience->job_title) }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('company', __('messages.company').':') }}
        <p>{{ html_entity_decode($experience->company) }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('country_id', __('messages.country').':') }}
        <p>{{ html_entity_decode($experience->country->name) }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('state_id', __('messages.state').':') }}
        <p>{{ html_entity_decode($experience->state->name) }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('city_id', __('messages.city').':') }}
        <p>{{ html_entity_decode($experience->city->name) }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('currently_work_here', __('messages.current_work_here').':') }}
        <p>{{ ($experience->currently_work_here)?'Yes':'No' }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('start_date', __('messages.start_date').':') }}
        <p><span>{{ \Carbon\Carbon::parse($experience->start_date)->format('jS M, Y') }}</span>
        </p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('end_date', __('messages.end_date').':') }}
        <p>
            <span>{{  !empty($experience->end_date)?\Carbon\Carbon::parse($experience->end_date)->format('jS M, Y'):'N/A' }}</span>
        </p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('created_at', __('messages.created_on').':') }}
        <p><span data-toggle="tooltip" data-placement="right"
                 title="{{ date('jS M, Y', strtotime($experience->created_at)) }}">{{ $experience->created_at->diffForHumans() }}</span>
        </p>
    </div>
    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('updated_at', __('messages.last_updated').':') }}
        <p><span data-toggle="tooltip" data-placement="right"
                 title="{{ date('jS M, Y', strtotime($experience->updated_at)) }}">{{ $experience->updated_at->diffForHumans() }}</span>
        </p>
    </div>
</div>
