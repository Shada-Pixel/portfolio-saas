<div id="editProfileModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('messages.user.edit_profile')}}</h5>
                <button type="button" aria-label="Close" class="close outline-none" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'editProfileForm','files'=>true]) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="validationErrorsBox"></div>
                {{csrf_field()}}
                <div class="row">
                    <div class="form-group col-sm-6">
                        {{ Form::label('first name', __('messages.first_name').':') }}<span class="required text-red">*</span>
                        {{ Form::text('first_name', null, ['id'=>'pfName','class' => 'form-control firstName','required', 'autofocus', 'tabindex' => "1",'placeholder' => __('messages.first_name')]) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('last name', __('messages.last_name').':') }}<span class="required text-red">*</span>
                        {{ Form::text('last_name', null, ['id'=>'plName','class' => 'form-control','required', 'autofocus', 'tabindex' => "2",'placeholder' => __('messages.last_name')]) }}
                    </div>
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <div class="col-6 col-xl-5">
                                {{ Form::label('image', __('messages.profile').':') }}<i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip" data-placement="top" title="{{__('messages.user.edit_profile_tooltip')}}"></i>
                                <label class="image__file-upload text-white"> {{ __('messages.choose') }}
                                    {{ Form::file('photo',['id'=>'profileImage','class' => 'd-none','accept'=>'image/gif,image/png,image/jpg,image/jpeg']) }}
                                </label>
                            </div>
                            <div class="col-6 col-xl-6 pl-0 mt-1">
                                <img id='previewImage' class="img-thumbnail thumbnail-preview"
                                     src="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('email', __('messages.email').':') }}<span class="required text-red">*</span>
                        {{ Form::email('email', null, ['id'=>'pfEmail','class' => 'form-control','required', 'tabindex' => "3",'placeholder' => __('messages.enter_email')]) }}
                    </div>
                </div>
                    {{ Form::button(__('messages.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnPrEditSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing...", 'tabindex' => "4"]) }}
                    <button type="button" class="btn text-dark btn-light ml-1 edit-cancel-margin margin-left-5"
                            data-dismiss="modal">{{__('messages.cancel')}}
                    </button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
