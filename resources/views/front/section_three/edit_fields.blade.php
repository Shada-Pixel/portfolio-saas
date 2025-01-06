<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group">
                    {{ Form::label('s3_text_title', __('messages.front_side_cms.s3_text_title').':') }}<span
                            class="text-danger">*</span>
                    {{ Form::text('s3_text_title', $sectionThreeFront['s3_text_title'], ['class' => 'form-control','placeholder' => __('messages.front_side_cms.s3_text_title'), 'required', 'maxlength' => '30']) }}
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row">
                    <div class="px-3">
                        {{ Form::label('s3_image_main', __('messages.front_side_cms.s3_image_main').':') }}
                        <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip"
                           data-placement="top" title="{{__('messages.front_side_cms.s3_image_main_tooltip')}}"></i>
                        <label class="image__file-upload text-white"> {{ __('messages.choose') }}
                            {{ Form::file('s3_image_main',['class' => 'd-none cms-attachment', 'data-attachment-preview' => '0']) }}
                        </label>
                    </div>
                    <div class="w-auto mt-2 pl-sm-0 pl-3">
                        <img id='attachmentPreview_0' name="cms-attachment" class="img-thumbnail thumbnail-preview"
                             src="{{ $sectionThreeFront['s3_image_main'] }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="form-group">
            {{ Form::label('image_text', __('messages.front_side_cms.s3_image_text_one').':') }}<span
                    class="text-danger">*</span>
            {{ Form::text('image_text', null , ['class' => 'form-control','placeholder' => __('messages.front_side_cms.s3_image_text_one'),'maxlength' => 20,'required']) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="form-group">
            {{ Form::label('image_text_secondary', __('messages.front_side_cms.s3_image_text_one_secondary').':') }}
            <span class="text-danger">*</span>
            {{ Form::text('image_text_secondary', null , ['class' => 'form-control','placeholder' => __('messages.front_side_cms.s3_image_text_one_secondary'),'maxlength' => 20,'required']) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="form-group">
            <div class="row">
                <div class="px-3">
                    {{ Form::label('image_url', __('messages.front_side_cms.s3_image_one').':') }}
                    <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip"
                       data-placement="top" title="{{__('messages.front_side_cms.s3_image_tooltip_one')}}"></i>
                    <label class="image__file-upload text-white"> {{ __('messages.choose') }}
                        {{ Form::file('image_url',['class' => 'd-none cms-attachment', 'data-attachment-preview' => '1']) }}
                    </label>
                </div>
                <div class="w-auto mt-2 pl-sm-0 pl-3">
                    <img id='attachmentPreview_1' name="cms-attachment" class="img-thumbnail thumbnail-preview"
                         src="{{ $sectionThree->image_url }}">

                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12">
        <div class="form-group">
            {{ Form::label('slider_text', __('messages.front_side_cms.s3_text_slider_one').':') }}<span
                    class="text-danger">*</span>
            {{ Form::textarea('slider_text', null, ['class' => 'form-control', 'rows'=>4, 'required', 'placeholder' => __('messages.front_side_cms.s3_add_slider_text'), 'maxlength' => '200']) }}
        </div>
    </div>

    <div class="form-group col-sm-12 mt-3 d-flex align-items-center">
        {{ Form::button(__('messages.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
        <a href="{{ route('section-three.index') }}"
           class="btn btn-light text-dark ml-1">{{__('messages.cancel')}}</a>
    </div>
</div>
