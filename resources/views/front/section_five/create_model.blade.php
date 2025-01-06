<div class="modal fade p-0" id="addSectionFiveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('messages.front_side_cms.create_section')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="validationErrorsBoxTestimonial"></div>
                {{ Form::open(['id' =>'sectionFiveForm','method'=>'post']) }}
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('text_main', __('messages.front_side_cms.s5_main_text').':') }}<span class="text-danger">*</span>
                        {{ Form::text('text_main', null , ['class' => 'form-control','placeholder' => __('messages.front_side_cms.s5_main_text'),'required']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('text_secondary', __('messages.front_side_cms.text_secondary').':') }}<span class="text-danger">*</span>
                        {{ Form::text('text_secondary', null , ['class' => 'form-control','placeholder' => __('messages.front_side_cms.text_secondary'),'required']) }}
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'sectionFiveSaveBtn', 'data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    {{ Form::button(__('messages.cancel'), ['type' => 'button', 'class' => 'btn btn-light text-dark','data-dismiss'=>'modal']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
