<div class="modal fade p-0" id="recentWorkTypesModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">{{__('messages.new_recent_work_type')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(['id' =>'recentWorkTypeForm','method'=>'post']) }}
                <div class="form-group">
                    {{ Form::label('name', __('messages.name').':') }}<span class="text-danger">*</span>
                    {{ Form::text('name', null , ['class' => 'form-control','placeholder' => __('messages.enter_recent_work_type'),'required']) }}
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
