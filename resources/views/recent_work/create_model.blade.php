<div class="modal fade p-0" id="recentWorksModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">{{__('messages.new_recent_work')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="validationErrorsBox"></div>
                {{ Form::open(['id' =>'recentWorkForm','method'=>'post','files' => true]) }}
                <div class="form-group col-xl-12 col-md-12 col-sm-12">
                    {{ Form::label('type_id',__('messages.recent_work_type').':') }}<span class="text-danger">*</span>
                    {{ Form::select('type_id', $recentWorkTypes, null, ['id'=>'recentWorkType','class' => 'form-control','placeholder' => __('messages.recent_work_placeholder.select_recent_work_type'),'required']) }}
                </div>
                <div class="form-group col-xl-12 col-md-12 col-sm-12">
                    {{ Form::label('title',__('messages.title').':') }}<span class="text-danger">*</span>
                    {{ Form::text('title', null, ['class' => 'form-control','placeholder' => __('messages.recent_work_placeholder.enter_title'),'required']) }}
                </div>
                <div class="form-group col-xl-12 col-md-12 col-sm-12">
                    {{ Form::label('link',__('messages.link').':') }}
                    {{ Form::text('link', null, ['class' => 'form-control','placeholder' => __('messages.recent_work_placeholder.enter_link'),'id'=>'link']) }}
                </div>
                <div class="form-group col-xl-12 col-md-12 col-sm-12">
                    {{ Form::label('attachment', __('messages.attachments').':') }}<span
                            class="text-danger">*</span><span data-toggle="tooltip"
                                                              data-title="{{__('messages.recent_work_tooltip')}}">
                        <i class="fas fa-question-circle"></i></span>
                    <div id="attachmentFileSection" class="attachment__create mt-2"></div>
                    <label class="image__file-upload w-100 text-center cursor-pointer text-white"> {{ __('messages.attachments') }}
                        {{ Form::file('attachments[]',['id'=>'attachments','class' => 'd-none','accept' => 'image/png,image/jpg,image/jpeg','multiple']) }}
                    </label>
                </div>
                <div class="text-left d-flex align-items-center">
                    {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'saveBtn', 'data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" id="btnCancel" class="btn btn-light text-dark ml-1"
                            data-dismiss="modal">{{ __('messages.cancel') }}</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
