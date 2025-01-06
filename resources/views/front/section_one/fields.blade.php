<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="form-group">
            {{ Form::label('text_title', __('messages.front_side_cms.text_title').':') }}<span
                    class="text-danger">*</span>
            {{ Form::text('text_title', $sectionOne['text_title'], ['class' => 'form-control','placeholder' => __('messages.front_side_cms.text_title'), 'required', 'max-length' => 9]) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="form-group">
            {{ Form::label('text_main_one', __('messages.front_side_cms.text_main_one').':') }}<span
                    class="text-danger">*</span>
            {{ Form::text('text_main_one', $sectionOne['text_main_one'], ['class' => 'form-control','placeholder' => __('messages.front_side_cms.text_main_one'), 'required', 'maxlength' => 9]) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="form-group">
            {{ Form::label('text_main_two', __('messages.front_side_cms.text_main_two').':') }}<span
                    class="text-danger">*</span>
            {{ Form::text('text_main_two', $sectionOne['text_main_two'], ['class' => 'form-control','placeholder' => __('messages.front_side_cms.text_main_two'), 'maxlength' => 9]) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="form-group">
            {{ Form::label('text_main_three', __('messages.front_side_cms.text_main_three').':') }}
            {{ Form::text('text_main_three', $sectionOne['text_main_three'], ['class' => 'form-control','placeholder' => __('messages.front_side_cms.text_main_three'), 'maxlength' => 9]) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="form-group">
            {{ Form::label('text_main_four', __('messages.front_side_cms.text_main_four').':') }}
            {{ Form::text('text_main_four', $sectionOne['text_main_four'], ['class' => 'form-control','placeholder' => __('messages.front_side_cms.text_main_four'), 'maxlength' => 9]) }}
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
        <div class="form-group">
            {{ Form::label('text_main_five', __('messages.front_side_cms.text_main_five').':') }}
            {{ Form::text('text_main_five', $sectionOne['text_main_five'], ['class' => 'form-control','placeholder' => __('messages.front_side_cms.text_main_five'), 'maxlength' => 9]) }}
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="form-group">
            {{ Form::label('text_secondary', __('messages.front_side_cms.text_secondary').':') }}<span
                    class="text-danger">*</span>
            {{ Form::textarea('text_secondary', $sectionOne['text_secondary'], ['class' => 'form-control', 'rows'=>3, 'required', 'placeholder' => __('messages.front_side_cms.text_secondary')]) }}
        </div>
    </div>
    <div class="col-12 d-flex align-items-center">
        {{ Form::button(__('messages.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSectionSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
        <a href="{{ route('cms.section.one.index') }}"
           class="btn btn-light text-dark ml-1">{{__('messages.cancel')}}</a>
    </div>
</div>
