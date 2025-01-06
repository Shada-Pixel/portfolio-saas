<div class="modal fade p-0" id="testimonialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('messages.new_testimonial')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="validationErrorsBoxTestimonial"></div>
                {{ Form::open(['id' =>'testimonialForm','method'=>'post','files' => true]) }}
                <div class="row">
                    <div class="form-group col-sm-6">
                        {{ Form::label('name', __('messages.name').':') }}<span class="text-danger">*</span>
                        {{ Form::text('name', null , ['class' => 'form-control','placeholder' => __('messages.testimonial_placeholder.enter_testimonial_name'),'required']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('position', __('messages.position').':') }}<span class="text-danger">*</span>
                        {{ Form::text('position', null , ['class' => 'form-control','placeholder' => __('messages.testimonial_placeholder.enter_position'),'required']) }}
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('description', __('messages.description').':') }}<span class="text-danger">*</span>
                        <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip"
                           data-placement="top" title="{{__('The Description Should Be 295 Character')}}"></i>
                        {{__('messages.remaining_characters').':'}} <span id="characterCount"></span>
                        {{ Form::textarea('description', null , ['class' => 'form-control', 'maxlength' => 295,'id'=>'description', 'required', 'placeholder' => __('messages.testimonial_placeholder.testimonial_description'),]) }}
                    </div>
                    <div class="form-group col-sm-6">
                        <div class="row">
                            <div class="px-3">
                                {{ Form::label('Image', __('messages.image').':') }}<span class="text-danger">*</span>
                                <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip" data-placement="top"
                                   title="{{__('messages.image_must_255px')}}"></i>
                                <label class="image__file-upload text-white"> {{ __('messages.choose') }}
                                    {{ Form::file('image',['id'=>'image','class' => 'd-none','accept'=>'image/gif,image/png,image/jpg,image/jpeg']) }}
                                </label>
                            </div>
                            <div class="w-auto mt-2">
                                <img id='imgPreview' class="img-thumbnail thumbnail-preview"
                                     src="{{asset('img/infyom-logo.png')}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'testimonialSaveBtn', 'data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    {{ Form::button(__('messages.cancel'), ['type' => 'button', 'class' => 'btn btn-light text-dark','data-dismiss'=>'modal']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
