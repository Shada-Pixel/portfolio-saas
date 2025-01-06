<div class="modal fade p-0" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('messages.testimonials_details')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(['id' => 'showForm']) }}
                <div class="row details-page">
                    <div class="form-group col-lg-4 col-md-6 col-12">
                        {{ Form::label('name', __('messages.name').':') }}<br>
                        <span id="showName"></span>
                    </div>

                    <div class="form-group col-lg-4 col-md-6 col-12">
                        {{ Form::label('position', __('messages.position').':') }}<br>
                        <span id="showPosition"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-12">
                        <div class="row">
                            <div class="col-12">
                                {{ Form::label('Image', __('messages.image').':')}}
                            </div>
                            <div class="mt-1 col-12">
                                <img id='showImage' class="img-thumbnail thumbnail-preview"
                                     src="{{asset('img/favicon.png')}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-12">
                        {{ Form::label('created on', __('messages.created_on').':') }}<br>
                        <span id="showCreatedOn"></span>
                    </div>

                    <div class="form-group col-lg-4 col-md-6 col-12">
                        {{ Form::label('updated on', __('messages.last_updated').':') }}<br>
                        <span id="showUpdatedOn"></span>
                    </div>

                    <div class="form-group col-sm-12">
                        {{ Form::label('description', __('messages.description').':') }}<br>
                        <span class="custom-description" id="showDescription"></span>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

