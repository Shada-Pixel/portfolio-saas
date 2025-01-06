<div class="modal fade p-0" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel">{{__('messages.blogs_category.new_category')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(['id' =>'createCategoryForm','method'=>'post']) }}
                <div class="row">
                    <div class="form-group col-lg-6 col-sm-12">
                        {{ Form::label('name', __('messages.name').':') }}<span class="text-danger">*</span>
                        {{ Form::text('name', null , ['class' => 'form-control','required','placeholder' => __('messages.category_placeholder.enter_name'),'id'=>'categoryTitle']) }}
                    </div>
                    <div class="form-group col-lg-6 col-sm-12">
                        {{ Form::label('slug', __('messages.blogs_category.slug').':') }}<span class="text-danger">*</span>
                        {{ Form::text('slug', null , ['class' => 'form-control','placeholder' => __('messages.category_placeholder.enter_slug'),'required','id'=>'categorySlugValue']) }}
                    </div>
                    <div class="form-group col-12">
                        {{ Form::label('description', __('messages.description').':') }}
                        {{ Form::textarea('description', null , ['class' => 'form-control','id'=>'categoryDescription']) }}
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'saveBtn', 'data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    {{ Form::button(__('messages.cancel'), ['type' => 'button', 'class' => 'btn btn-light text-dark','data-dismiss'=>'modal']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
