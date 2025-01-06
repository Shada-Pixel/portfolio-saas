<div class="modal fade" id="skillsModal" tabindex="-1" role="dialog" aria-labelledby="skillsModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="skillsModalLabel">{{__('messages.new_skill')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(['id' =>'skillForm','method'=>'post']) }}
                <div class="form-group">
                    {{ Form::label('name', __('messages.name').':') }}<span class="text-danger">*</span>
                    <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip"
                       data-placement="top" title="{{__('messages.skill_name_tooltip')}}"></i>
                    {{ Form::text('name', null , ['class' => 'form-control','placeholder' => __('messages.skill_placeholder.enter_skill_name'),'required']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('percentage', __('messages.percentage').':') }}<span class="text-danger">*</span>
                    {{ Form::number('percentage', null , ['class' => 'form-control','placeholder' => __('messages.skill_placeholder.enter_percentage'), 'min' => 1, 'max' => 100,'required', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")']) }}
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
