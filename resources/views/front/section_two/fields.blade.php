<div class="row">
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="form-group">
            {{ Form::label('s2_text_title', __('messages.front_side_cms.s2_text_title').':') }}<span
                    class="text-danger">*</span>
            {{ Form::text('s2_text_title', $sectionTwo['s2_text_title'], ['class' => 'form-control','placeholder' => __('messages.front_side_cms.s2_text_title'), 'required', 'maxlength' => '45']) }}
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="form-group">
            {{ Form::label('s2_link_one_text', __('messages.front_side_cms.s2_link_one_text').':') }}<span
                    class="text-danger">*</span>
            {{ Form::text('s2_link_one_text', $sectionTwo['s2_link_one_text'], ['class' => 'form-control','placeholder' => __('messages.front_side_cms.s2_link_one_text'), 'required', 'maxlength' => '10']) }}
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="form-group">
            {{ Form::label('s2_link_one_link', __('messages.front_side_cms.s2_link_one_link').':') }}<span
                    class="text-danger">*</span>
            {{ Form::text('s2_link_one_link', $sectionTwo['s2_link_one_link'], ['class' => 'form-control','placeholder' => __('messages.front_side_cms.s2_link_one_link'), 'required']) }}
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="form-group">
            {{ Form::label('s2_link_two_text', __('messages.front_side_cms.s2_link_two_text').':') }}<span
                    class="text-danger">*</span>
            {{ Form::text('s2_link_two_text', $sectionTwo['s2_link_two_text'], ['class' => 'form-control','placeholder' => __('messages.front_side_cms.s2_link_two_text'), 'required', 'maxlength' => '10']) }}
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="form-group">
            {{ Form::label('s2_link_two_link', __('messages.front_side_cms.s2_link_two_link').':') }}<span
                    class="text-danger">*</span>
            {{ Form::text('s2_link_two_link', $sectionTwo['s2_link_two_link'], ['class' => 'form-control','placeholder' => __('messages.front_side_cms.s2_link_two_link'), 'required']) }}
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="form-group">
            {{ Form::label('s2_counter_one_value', __('messages.front_side_cms.s2_counter_one_value').':') }}<span
                    class="text-danger">*</span>
            {{ Form::text('s2_counter_one_value', $sectionTwo['s2_counter_one_value'], ['class' => 'form-control','placeholder' => __('messages.front_side_cms.s2_counter_one_value'), 'required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'maxlength' => '3']) }}
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="form-group">
            {{ Form::label('s2_counter_one_text', __('messages.front_side_cms.s2_counter_one_text').':') }}<span
                    class="text-danger">*</span>
            {{ Form::text('s2_counter_one_text', $sectionTwo['s2_counter_one_text'], ['class' => 'form-control','placeholder' => __('messages.front_side_cms.s2_counter_one_text'), 'required', 'maxlength' => '25']) }}
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="form-group">
            {{ Form::label('s2_counter_two_value', __('messages.front_side_cms.s2_counter_two_value').':') }}<span
                    class="text-danger">*</span>
            {{ Form::text('s2_counter_two_value', $sectionTwo['s2_counter_two_value'], ['class' => 'form-control','placeholder' => __('messages.front_side_cms.s2_counter_two_value'), 'required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'maxlength' => '3']) }}
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="form-group">
            {{ Form::label('s2_counter_two_text', __('messages.front_side_cms.s2_counter_two_text').':') }}<span
                    class="text-danger">*</span>
            {{ Form::text('s2_counter_two_text', $sectionTwo['s2_counter_two_text'], ['class' => 'form-control','placeholder' => __('messages.front_side_cms.s2_counter_two_text'), 'required', 'maxlength' => '25']) }}
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="form-group">
            {{ Form::label('s2_counter_three_value', __('messages.front_side_cms.s2_counter_three_value').':') }}<span
                    class="text-danger">*</span>
            {{ Form::text('s2_counter_three_value', $sectionTwo['s2_counter_three_value'], ['class' => 'form-control','placeholder' => __('messages.front_side_cms.s2_counter_three_value'), 'required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")', 'maxlength' => '3']) }}
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="form-group">
            {{ Form::label('s2_counter_three_text', __('messages.front_side_cms.s2_counter_three_text').':') }}<span
                    class="text-danger">*</span>
            {{ Form::text('s2_counter_three_text', $sectionTwo['s2_counter_three_text'], ['class' => 'form-control','placeholder' => __('messages.front_side_cms.s2_counter_three_text'), 'required', 'maxlength' => '25']) }}
        </div>
    </div>
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-md-0 mb-4">
        <div class="row">
            <div class="px-3">
                {{ Form::label('s2_background_image', __('messages.front_side_cms.s2_background_image').':') }}
                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip" data-placement="top"  title="{{__('messages.front_side_cms.s2_background_tooltip')}}"></i>
                <label class="image__file-upload text-white"> {{ __('messages.choose') }}
                    {{ Form::file('s2_background_image',['class' => 'd-none cms-attachment', 'data-attachment-preview' => '1']) }}
                </label>
            </div>
            <div class="w-auto mt-2 pl-sm-0 pl-3">
                <img id='attachmentPreview_1' name="cms-attachment" class="img-thumbnail thumbnail-preview"
                     src="{{ $sectionTwo['s2_background_image']  }}">

            </div>
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="form-group">
            {{ Form::label('s2_text_secondary', __('messages.front_side_cms.s2_text_secondary').':') }}<span
                    class="text-danger">*</span>
            {{ Form::textarea('s2_text_secondary', $sectionTwo['s2_text_secondary'], ['class' => 'form-control', 'rows'=>3, 'required', 'placeholder' => __('messages.front_side_cms.s2_text_secondary'), 'maxlength' => '200']) }}
        </div>
    </div>
    <div class="col-12 d-flex align-items-center">
        {{ Form::button(__('messages.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSectionSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
        <a href="{{ route('cms.section.two.index') }}"
           class="btn btn-light text-dark ml-1">{{__('messages.cancel')}}</a>
    </div>
</div>
