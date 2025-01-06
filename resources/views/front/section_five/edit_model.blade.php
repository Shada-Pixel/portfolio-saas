<div class="modal fade p-0" id="editSectionFiveModal" tabindex="-1" role="dialog" aria-labelledby="sectionFiveModalLabel"
     aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sectionFiveModalLabel">{{__('messages.front_side_cms.edit_section')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="editValidationErrorsBox"></div>
                {{ Form::open(['id' =>'sectionFiveUpdateForm','method'=>'post', 'files' => true]) }}
                {{ Form::hidden('id',null,['id' => 'sectionFiveId']) }}
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('text_main', __('messages.front_side_cms.s5_main_text').':') }}<span class="text-danger">*</span>
                        {{ Form::text('text_main', null , ['class' => 'form-control','id'=>'textMain','required', 'placeholder' => __('messages.front_side_cms.s5_main_text')]) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('text_secondary', __('messages.front_side_cms.text_secondary').':') }}<span class="text-danger">*</span>
                        {{ Form::text('text_secondary', null , ['class' => 'form-control', 'id'=>'textSecondary', 'placeholder' => __('messages.front_side_cms.text_secondary'),'required']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('s5_text_title', __('messages.front_side_cms.s5_text_title').':') }}<span class="text-danger">*</span>
                        {{ Form::text('s5_text_title', null , ['class' => 'form-control', 'id'=>'sectionFiveTitle', 'placeholder' => __('messages.front_side_cms.s5_text_title'),'required']) }}
                    </div>
                    <div class="form-group col-12">
                        <div class="row">
                            <div class="px-3">
                                {{ Form::label('Image', __('messages.image').':') }}
                                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip" data-placement="top"
                                   title="{{__('messages.front_side_cms.s5_image_tooltip')}}"></i>
                                <label class="image__file-upload text-white"> {{ __('messages.choose') }}
                                    {{ Form::file('s5_main_image', ['id'=>'editImage','class' => 'd-none','accept'=>'image/gif,image/png,image/jpg,image/jpeg']) }}
                                </label>
                            </div>
                            <div class="w-auto mt-2">
                                <img id='editImagePreview' class="img-thumbnail thumbnail-preview" src="">
                            </div>  
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'sectionFiveUpdateSaveBtn', 'data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    {{ Form::button(__('messages.cancel'), ['type' => 'button', 'class' => 'btn btn-light text-dark','data-dismiss'=>'modal']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
