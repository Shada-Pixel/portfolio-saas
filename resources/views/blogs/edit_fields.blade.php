<div class="row">
    <div class="form-group col-md-6">
        {{ Form::label('title', __('messages.title').':') }}<span class="text-danger">*</span>
        {{ Form::text('title', $blog->title , ['class' => 'form-control','placeholder' => __('messages.blog_placeholder.enter_title'),'required','id'=>'blogTitle']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('slug', __('messages.blogs_category.slug').':') }}<span class="text-danger">*</span>
        {{ Form::text('slug', $blog->slug , ['class' => 'form-control','placeholder' => __('messages.blog_placeholder.enter_slug'),'required','id'=>'slugValue']) }}
    </div>
    <div class="form-group col-md-6">
        {{ Form::label('category_id', __('messages.blogs_category.category').':') }}<span class="text-danger">*</span>
        <div class="d-flex">
        {{ Form::select('category_id',$category,$blog->category_id, ['id'=>'editCategory','class' => 'form-control','required', 'placeholder' => __('messages.blog_placeholder.select_category')]) }}
            <div class="input-group-text">
              <a href="#"  class="float-right" data-toggle="modal" data-target="#categoryModal"><i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div>

    <div class="form-group col-md-6">
        <div class="row">
            <div class="px-3">
                {{ Form::label('image', __('messages.blogs_category.hero_image').':') }}<i class="fas fa-question-circle ml-1 mt-1 general-question-mark"
                                                               data-toggle="tooltip" data-placement="top"
                                                               title="{{__('messages.blogs_category.image_text')}}"></i>
                <label class="image__file-upload text-white"> {{ __('messages.choose') }}
                    {{ Form::file('image',['id'=>'img','class' => 'd-none','accept'=>'image/gif,image/png,image/jpg,image/jpeg']) }}
                </label>
            </div>
            <div class="w-auto mt-2 pl-sm-0 pl-3">
                <img id='imgPreview' name="media_id" class="img-thumbnail thumbnail-preview"
                     src=" {{asset($blog->image_url) ? $blog->image_url:  asset('img/infyom-logo.png')}}">

            </div>
        </div>
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('status', __('messages.blogs_category.status').':') }}
        <div class="selectgroup selectgroup-pills">
            <label class="selectgroup-item">
                <input type="radio" name="is_published" value="1"
                       class="selectgroup-input" {{ $blog->is_published == \App\Models\Blog::PUBLISHED ? 'checked' : '' }}>
                <span class="selectgroup-button selectgroup-button-icon" title="{{__('messages.blogs_category.publish')}}"
                      data-toggle="tooltip" data-placement="top"><i
                            class="fas fa-eye"></i></span>
            </label>
            <label class="selectgroup-item">
                <input type="radio" name="is_published" value="0"
                       class="selectgroup-input" {{ $blog->is_published == \App\Models\Blog::DRAFT ? 'checked' : '' }}>
                <span class="selectgroup-button selectgroup-button-icon" title="{{__('messages.blogs_category.draft')}}"
                      data-toggle="tooltip" data-placement="top"><i
                        class="fas fa-eye-slash"></i></span>
            </label>
        </div>
    </div>
    <div class="form-group col-sm-6">
        {{ Form::label('is_featured', __('messages.blogs_category.is_featured').':') }}<br>
        <label class="custom-toggle">
            <input type="checkbox" name="is_featured" {{ $blog->is_featured ? 'checked' : '' }}>
            <span class="custom-toggle-slider rounded-circle"></span>
        </label>
    </div>
    <div class="form-group col-md-12 blog-body">
        {{ Form::label('description', __('messages.blogs_category.body').':') }}<span class="text-danger">*</span>
        {{ Form::textarea('description',$blog->description , ['class' => 'form-control','id'=>'editDescription']) }}
    </div>
    <hr>
    <div class="form-group col-sm-12 mt-3 d-flex align-items-center">
        {{ Form::button(__('messages.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
        <a href="{{ route('blogs.index') }}" class="btn btn-light text-dark ml-1">{{__('messages.cancel')}}</a>
    </div>
</div>
