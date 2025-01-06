<div class="row view-spacer">
    <div class="col-lg-3 col-md-4">
        <div class="form-group">
            {{ Form::label('full_name', __('messages.name').':') }}
            <p>{{ $hireMe->name }}</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-4">
        <div class="form-group">
            {{ Form::label('email', __('messages.email').':') }}
            <p>{{ $hireMe->email }}</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-4">
        <div class="form-group">
            {{ Form::label('mobile', __('messages.hire_request.mobile').':') }}
            <p>{{ $hireMe->mobile ?? 'N/A'}}</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-4">
        <div class="form-group">
            {{ Form::label('company name', __('messages.company_name').':') }}
            <p>{{ $hireMe->company_name }}</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-4">
        <div class="form-group">
            {{ Form::label('phone', __('messages.hire_request.interested_in').':') }}
            <p>{{ $hireMe->interested_in }}</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-4">
        <div class="form-group">
            {{ Form::label('phone', __('messages.hire_request.budget').':') }}
            <p> {{ number_format($hireMe->budget,2) }}</p>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            {{ Form::label('created_at', __('messages.created_on').':') }}<br>
            <span data-toggle="tooltip" data-placement="right"
                  title="{{ date('jS M, Y', strtotime($hireMe->created_at)) }}">{{ $hireMe->created_at->diffForHumans() }}</span>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('message', __('messages.hire_request.message').':') }}
            <br><span>{!! $hireMe->message ?? 'N/A' !!}</span>
        </div>
    </div>
</div>
