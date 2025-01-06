<div class="row details-page" xmlns="http://www.w3.org/1999/html">
    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('name', __('messages.title').':') }}
        <p>{{ html_entity_decode($recentWork->title ?? 'N/A') }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('type', __('messages.type').':') }}
        <p>{{ $recentWork->type->name ?? 'N/A' }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('link', __('messages.link').':') }}<br>
        @if(isset($recentWork->link))
            <a href="{{ $recentWork->link }}" class="text-blue">{{ $recentWork->link }}</a>
        @else
            <p>{{__('messages.n/a')}}</p>
        @endif
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('created_at', __('messages.created_on').':') }}
        <p><span data-toggle="tooltip" data-placement="right"
                 title="{{ date('jS M, Y', strtotime($recentWork->created_at)) }}">{{ $recentWork->created_at->diffForHumans() }}</span>
        </p>
    </div>
    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('updated_at', __('messages.last_updated').':') }}
        <p><span data-toggle="tooltip" data-placement="right"
                 title="{{ date('jS M, Y', strtotime($recentWork->updated_at)) }}">{{ $recentWork->updated_at->diffForHumans() }}</span>
        </p>
    </div>
    <div class="form-group col-xl-9 col-md-9 col-sm-12">
        {{ Form::label('Attachments', __('messages.attachments').':') }}<br>
        @if(isset($recentWork->media_full_url) && $recentWork->media_full_url != '')
            <div class="d-flex flex-wrap attachment-display">
                @foreach($recentWork->media_full_url  as $key => $attachment)
                    <div class="d-flex position-relative display-images">
                        <img src="{{ $attachment }}" height="auto" width="100" alt="" class="mr-2"/>
                        <div class="position-absolute d-flex attachment-icon">
                            <a class="attachment attachment-view mr-1" href="{{ $attachment}}" target="_blank">
                                <i class="fas fa-eye text-primary"></i>
                            </a>
                            <a class="attachment attachment-download mr-1"
                               href="{{ route('recent.work.attachments-download', $key) }}">
                                <i class="fas fa-download text-info"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <span>N/A</span>
        @endif
    </div>
</div>
