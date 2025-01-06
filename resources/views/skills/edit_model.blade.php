<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="skillModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="skillModalLabel">{{__('messages.edit_skill')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert-danger alert d-none" id="editValidationErrorsBox"></div>
                {{ Form::open(['id' =>'skillUpdateForm','method'=>'post']) }}
                {{ Form::hidden('id',null,['id' => 'skillId']) }}
                <div class="form-group">
                    {{ Form::label('name', __('messages.name').':') }}<span class="text-danger">*</span>
                    <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip"
                       data-placement="top" title="{{__('messages.skill_name_tooltip')}}"></i>
                    {{ Form::text('name', null , ['class' => 'form-control','id' => 'editName','placeholder' => __('messages.skill_placeholder.enter_skill_name'),'required']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('percentage', __('messages.percentage').':') }}<span class="text-danger">*</span>
                    {{ Form::number('percentage', null , ['class' => 'form-control','id' => 'editPercentage','placeholder' => __('messages.skill_placeholder.enter_percentage'), 'min' => 1, 'max' => 100,'required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
                </div>
                <div class="d-flex align-items-center">
                    {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'skillSaveBtn', 'data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    {{ Form::button(__('messages.cancel'), ['type' => 'button', 'class' => 'btn btn-light text-dark','data-dismiss'=>'modal']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>


