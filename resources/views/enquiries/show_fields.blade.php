<div class="row view-spacer">
    <div class="col-lg-3 col-md-4">
        <div class="form-group">
            {{ Form::label('full_name', __('messages.name').':') }}
            <p>{{ $enquiry->full_name }}</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-4">
        <div class="form-group">
            {{ Form::label('email', __('messages.email').':') }}
            <p>{{ $enquiry->email }}</p>
        </div>
    </div>
    <div class="col-lg-2 col-md-4">
        <div class="form-group">
            {{ Form::label('phone', __('messages.phone').':') }}
            <p>{{ $enquiry->phone }}</p>
        </div>
    </div>
    <div class="col-lg-2 col-md-4">
        <div class="form-group">
            {{ Form::label('status', __('messages.enquiries.status').':') }}
            <p>{{ ($enquiry->status) ? __('Read') : __('Unread') }}</p>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            {{ Form::label('created_at', __('messages.created_on').':') }}<br>
            <span data-toggle="tooltip" data-placement="right"
                  title="{{ date('jS M, Y', strtotime($enquiry->created_at)) }}">{{ $enquiry->created_at->diffForHumans() }}</span>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            {{ Form::label('message', __('messages.enquiries.message').':') }}
            <p>{!! nl2br(e($enquiry->message)) !!}</p>
        </div>
    </div>
</div>
