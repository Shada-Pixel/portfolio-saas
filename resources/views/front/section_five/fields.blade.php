<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group">
                    {{ Form::label('s5_text_title', __('messages.front_side_cms.s5_text_title').':') }}<span
                            class="text-danger">*</span>
                    {{ Form::text('s5_text_title', $sectionFive['s5_text_title'], ['class' => 'form-control','placeholder' => __('messages.front_side_cms.s5_text_title'), 'required', 'maxlength' => '40']) }}
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="row">
                    <div class="px-3">
                        {{ Form::label('s5_main_image', __('messages.front_side_cms.s5_main_image').':') }}
                        <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip" data-placement="top"  title="{{__('messages.front_side_cms.s5_image_tooltip')}}"></i>
                        <label class="image__file-upload text-white"> {{ __('messages.choose') }}
                            {{ Form::file('s5_main_image',['class' => 'd-none cms-attachment', 'data-attachment-preview' => '1']) }}
                        </label>
                    </div>
                    <div class="w-auto mt-2 pl-sm-0 pl-3">
                        <img id='attachmentPreview_1' name="cms-attachment" class="img-thumbnail thumbnail-preview"
                             src="{{ $sectionFive['s5_main_image'] }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 mt-3">
        <div class="mb-3 h5">
            {{__('messages.front_side_cms.s5_add_card_section')}}:<span class="text-danger">*</span>
        </div>
        <table class="table table-bordered table-responsive-sm" id="sectionFiveAccordionTbl">
            <thead class="">
            <tr class="text-center">
                <th class="text-center pb-3">#</th>
                <th class="plan-attribute-filed pb-3">{{__('messages.front_side_cms.s5_one_text_one')}}<span
                            class="text-danger">*</span>
                </th>
                <th class="plan-attribute-filed pb-3">{{__('messages.front_side_cms.s5_one_text_two')}}<span
                            class="text-danger">*</span>
                </th>
                <th>
                    <button type="button" class="btn btn-sm btn-primary float-right w-100"
                            id="addItem"><i class="fa fa-plus"></i></button>
                </th>
            </tr>
            </thead>
            <tbody class="accordion-attribute-container">
            <tr>
                <td class="text-center item-number">1</td>
                <td>
                    <div class="form-group">
                        {{ Form::text('s5_one_text_one[]', '', ['class' => 'form-control','placeholder' => __('messages.front_side_cms.s5_one_text_one'), 'required', 'maxlength' => '25']) }}
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        {{ Form::textarea('s5_one_text_two[]', '', ['class' => 'form-control', 'rows'=>5, 'required', 'placeholder' => __('messages.front_side_cms.s5_one_text_two'), 'maxlength' => '200']) }}
                    </div>
                </td>
                <td class="text-center">
                    <a href="javascript:void(0)"
                       class="btn btn-danger btn-icon-only-action rounded-circle delete-plan-attribute">
                        <span class="btn-inner--icon"><i class="fa fa-trash"></i></span>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="col-12 d-flex align-items-center mt-3">
        {{ Form::button(__('messages.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSectionSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
        <a href="{{ route('cms.section.three.index') }}"
           class="btn btn-light text-dark ml-1">{{__('messages.cancel')}}</a>
    </div>
</div>
