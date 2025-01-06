<div class="row">
    <div class="form-group col-md-12">
        {{ Form::label('choose_template', __('messages.vCards.choose_template').':') }}<span
                class="text-danger">*</span>
    </div>
    <div class="form-group col-md-12 vcard-template">
        <label class="img-btn">
            <input type="radio" name="template_id" value="1" checked>
            <img src="{{ asset('assets/web/css/images/vCard-template-one.png') }}" class="img-thumbnail template-image"
                 alt="Template 1">
        </label>
        <label class="img-btn">
            <input type="radio" name="template_id" value="2">
            <img src="{{ asset('assets/web/css/images/vCard-template-Two.png') }}" class="img-thumbnail template-image"
                 alt="Template 2">
        </label>
        <label class="img-btn">
            <input type="radio" name="template_id" value="3">
            <img src="{{ asset('assets/web/css/images/vCard-template-Three.png') }}"
                 class="img-thumbnail template-image" alt="Template 3">
        </label>
        <label class="img-btn">
            <input type="radio" name="template_id" value="4">
            <img src="{{ asset('assets/web/css/images/vCard-template-Four.png') }}" class="img-thumbnail template-image"
                 alt="Template 4">
        </label>
        <label class="img-btn">
            <input type="radio" name="template_id" value="5">
            <img src="{{ asset('assets/web/css/images/vCard-template-Five.png') }}" class="img-thumbnail template-image"
                 alt="Template 5">
        </label>
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('v_card_name', __('messages.vCards.v_card_name').':') }}<span class="text-danger">*</span>
        {{ Form::text('v_card_name', null , ['class' => 'form-control','placeholder' => __('messages.vCards.vCards_placeholder.enter_vCards_name'),'maxlength' => 20,'required']) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('name', __('messages.name').':') }}<span class="text-danger">*</span>
        {{ Form::text('name', null , ['class' => 'form-control','placeholder' => __('messages.vCards.vCards_placeholder.enter_name'),'maxlength' => 30,'required']) }}
    </div>
    <div class="form-group col-md-4">
        {{ Form::label('occupation', __('messages.vCards.occupation').':') }}<span class="text-danger">*</span>
        {{ Form::text('occupation', null, ['class' => 'form-control', 'placeholder' => __('messages.vCards.vCards_placeholder.enter_vCards_occupation'), 'maxlength' => 30, 'required']) }}
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="form-group">
            {{ Form::label('introduction', __('messages.vCards.introduction').':') }}<span
                    class="text-danger">*</span>
            {{ Form::textarea('introduction', null, ['class' => 'form-control', 'rows'=>3, 'required', 'maxlength' => 200, 'placeholder' => __('messages.vCards.vCards_placeholder.enter_vCards_introduction')]) }}
        </div>
    </div>
    <div class="form-group col-6">
        <div class="row">
            <div class="px-3">
                {{ Form::label('Image', __('messages.vCards.profile_image').':') }}
                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip"
                   data-placement="top" title="{{__('messages.vCards.profile_image_resolution')}}"></i>
                <label class="image__file-upload text-white"> {{ __('messages.choose') }}
                    {{ Form::file('profile_image',['id'=>'profileCardImage','class' => 'd-none', 'accept'=>'image/gif,image/png,image/jpg,image/jpeg', 'image/svg']) }}
                </label>
            </div>
            <div class="w-auto mt-2">
                <img id='profileImagePreview' class="img-thumbnail thumbnail-preview"
                     src="{{ getLoggedInUser()->profile_image }}">
            </div>
        </div>
    </div>
    <div class="form-group col-6">
        <div class="row">
            <div class="px-3">
                {{ Form::label('cover_image', __('messages.vCards.cover_image').':') }}
                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip"
                   data-placement="top" title="{{__('messages.vCards.cover_image_resolution')}}"></i>
                <label class="image__file-upload text-white"> {{ __('messages.choose') }}
                    {{ Form::file('cover_image',['id'=>'coverImage','class' => 'd-none', 'accept'=>'image/gif,image/png,image/jpg,image/jpeg', 'image/svg']) }}
                </label>
            </div>
            <div class="w-auto mt-2">
                <img id='coverImagePreview' class="img-thumbnail thumbnail-preview"
                     src="{{asset('img/infyom-logo.png')}}">
            </div>
        </div>
    </div>
    <hr>
    <div class="col-sm-12 mt-3">
        <div class="mb-3 h5">
            {{__('messages.vCards.add_information')}}
        </div>
        <table class="table table-bordered table-responsive-sm" id="informationTbl">
            <thead class="">
            <tr class="text-center">
                <th class="text-center pb-3">#</th>
                <th class="w-auto pb-3">{{__('messages.vCards.Icons')}}
                </th>
                <th class="w-auto pb-3">{{__('messages.vCards.color')}}
                </th>
                <th class="w-auto pb-3">{{__('messages.vCards.label')}}
                </th>
                <th class="w-auto pb-3">{{__('messages.vCards.url')}}
                </th>
                <th>
                    <button type="button" class="btn btn-sm btn-primary float-right w-100"
                            id="addItem"><i class="fa fa-plus"></i></button>
                </th>
            </tr>
            </thead>
            <tbody class="vCards-attribute-container">
            <tr>
                <td class="text-center item-number">1</td>
                <td class="text-center">
                    <button class="btn btn-primary button-icon-size mt-1 iconpicker dropdown-toggle createVCardAttribute"
                            data-iconset="fontawesome5"
                            data-icon="fas fa-ad" role="iconpicker" data-original-title="" title=""
                            aria-describedby="popover984402" id="iconPicker">
                    </button>
                    <input class="form-control plan-icon vcard-attribute-icon" name="icon[]" type="text" hidden
                           value="fas fa-ad">
                </td>
                <td class="text-center">
                    <div class="color-wrapper"></div>
                    <input class="form-control color icon-color" id="color" name="icon_color[]" type="hidden"
                           value="f5365c"/>
                </td>
                <td>
                    <input class="form-control" name="label_text[]"
                           type="text" maxlength="25" pattern="^\S[a-zA-Z ]+$" title="Attribute Label Not Allowed White Space"
                           placeholder="{{__('messages.vCards.vCards_placeholder.enter_label_name')}}">
                </td>
                <td>
                    <input class="form-control" maxlength="100" name="value_text[]" type="text"
                           placeholder="{{__('messages.vCards.vCards_placeholder.enter_value')}}">
                </td>
                <td class="text-center">
                    <a href="javascript:void(0)"
                       class="btn btn-danger btn-icon-only-action rounded-circle delete-vCards-attribute">
                        <span class="btn-inner--icon"><i class="fa fa-trash"></i></span>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>


    <div class="form-group col-sm-12 mt-3 d-flex align-items-center">
        {{ Form::button(__('messages.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
        <a href="{{ route('vcards.index') }}" class="btn text-dark btn-light ml-1">{{__('messages.cancel')}}</a>
    </div>
</div>
