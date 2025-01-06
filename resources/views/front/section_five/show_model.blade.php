<div class="modal fade p-0" id="showModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('messages.front_side_cms.section_details')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(['id' => 'showForm']) }}
                <div class="row details-page">
                    <div class="form-group col-lg-4 col-md-6 col-12">
                        {{ Form::label('text_main', __('messages.front_side_cms.s5_main_text').':') }}<br>
                        <span class="text-main"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-12">
                        {{ Form::label('Section Five Title', __('messages.front_side_cms.s5_text_title').':') }}<br>
                        <span class="custom-description section-five-title" ></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-12">
                        <div class="row">
                            <div class="col-12">
                                {{ Form::label('Image', __('messages.image').':')}}
                            </div>
                            <div class="mt-1 col-12">
                                <img class="img-thumbnail thumbnail-preview show-image"
                                     src="{{asset('img/favicon.png')}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-12">
                        {{ Form::label('text_secondary', __('messages.front_side_cms.text_secondary').':') }}<br>
                        <span class="text-title-secondary"></span>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-12">
                        {{ Form::label('created on', __('messages.created_on').':') }}<br>
                        <span class="show-created-on"></span>
                    </div>

                    <div class="form-group col-lg-6 col-md-6 col-12">
                        {{ Form::label('updated on', __('messages.last_updated').':') }}<br>
                        <span  class="show-updated-on"></span>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

