<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="form-group">
            {{ Form::label('image_text', __('messages.front_side_cms.s3_image_text_one').':') }}<span
                    class="text-danger">*</span>
            {{ Form::text('image_text', null , ['class' => 'form-control','placeholder' => __('messages.front_side_cms.s3_image_text_one'),'maxlength' => 20,'required']) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-4">
        <div class="form-group">
            <div class="row">
                <div class="px-3 col-6">
                    {{ Form::label('image_url', __('messages.front_side_cms.s3_image_one').':') }}<span
                            class="text-danger">*</span>
                    <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip"
                       data-placement="top" title="{{__('messages.front_side_cms.s4_image_tooltip')}}"></i>
                    <label class="image__file-upload text-white"> {{ __('messages.choose') }}
                        {{ Form::file('image_url',['class' => 'd-none cms-attachment', 'data-attachment-preview' => '1']) }}
                    </label>
                </div>
                <div class="w-auto mt-2 pl-sm-0 pl-3 col-6">
                    <img id='attachmentPreview_1' name="cms-attachment" class="img-thumbnail thumbnail-preview"
                         src="{{ asset('assets/front/images/testi/face.jpg')  }}">

                </div>
            </div>
        </div>
    </div>
    <div class="form-group col-sm-2">
        {{ Form::label('color', __('messages.color').':') }}<span class="text-danger">*</span>
        <div class="color-wrapper"></div>
        {{ Form::text('color', '#f5365c', ['id' => 'color', 'hidden', 'class' => 'form-control color']) }}
    </div>
    <div class="col-lg-12 col-md-12">
        <div class="form-group">
            {{ Form::label('image_text_description', __('messages.front_side_cms.s4_img_text_description').':') }}<span
                    class="text-danger">*</span>
            {{ Form::textarea('image_text_description', null, ['class' => 'form-control', 'rows'=>4, 'required', 'placeholder' => __('messages.front_side_cms.s4_img_text_description'), 'maxlength' => '200']) }}
        </div>
    </div>
    <div class="form-group col-sm-12 mt-3 d-flex align-items-center">
        {{ Form::button(__('messages.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
        <a href="{{ route('section-four.index') }}"
           class="btn btn-light text-dark ml-1">{{__('messages.cancel')}}</a>
    </div>
</div>
