<div class="modal fade" id="editModal"  role="dialog" aria-labelledby="serviceModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel">{{__('messages.edit_services')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="editValidationErrorsBox"></div>
                {{ Form::open(['id' =>'serviceUpdateForm','method'=>'post','files' => true]) }}
                {{ Form::hidden('service id',null,['id' => 'serviceId']) }}
                <div class="row">
                    <div class="form-group col-lg-7 col-sm-12 col-12">
                        {{ Form::label('name', __('messages.name').':') }}<span class="text-danger">*</span>
                        {{ Form::text('name', null , ['class' => 'form-control','id'=>'editName','required', 'placeholder' => __('messages.service_placeholder.enter_service_name')]) }}
                    </div>
                    <div class="form-group col-lg-2 col-sm-4 custom-col-width">
                        {{ Form::label('color', __('messages.color').':') }}<span class="text-danger">*</span>
                        <div class="edit-color-wrapper"></div>
                        {{ Form::text('color', '', ['id' => 'edit_color', 'hidden', 'class' => 'form-control color']) }}
                    </div>
                    <div class="form-group col-12">
                        <div class="row custom-service-row">
                            <div class="pl-3 pr-2">
                                {{ Form::label('Image', __('messages.image').':') }}<span class="text-danger">*</span>
                                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip"
                                   data-placement="top" title="{{__('messages.svgTooltipText')}}"></i>
                                <label class="image__file-upload text-white"> {{ __('messages.choose') }}
                                    {{ Form::file('icon',['id'=>'editIcon','class' => 'd-none']) }}
                                </label>
                            </div>
                            <div class="w-auto mt-2">
                                <img id='editIconPreview' class="img-thumbnail thumbnail-preview"
                                     src="{{asset('assets/img/infyom-logo.png')}}">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('description', __('messages.description').':') }}<span
                                class="text-danger">*</span>
                        <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip"
                           data-placement="top" title="{{__('messages.service_description_tooltip')}}"></i>
                        {{__('messages.remaining_characters').':'}} <span id="editCharacterCount"></span>
                        {{ Form::textarea('description', null , ['class' => 'form-control','maxlength' => 355,'id'=>'editDescription', 'required', 'placeholder' => __('messages.service_placeholder.add_service_description')]) }}
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'serviceSaveBtn', 'data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    {{ Form::button(__('messages.cancel'), ['type' => 'button', 'class' => 'btn btn-light text-dark','data-dismiss'=>'modal']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

