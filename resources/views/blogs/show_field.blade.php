<div class="row details-page post-card-lable">
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('title', __('messages.title').':') }}
        <p>{{ html_entity_decode($blog->title) }}</p>
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('category', __('messages.blogs_category.category').':') }}
        <p>{{ html_entity_decode($blog->category->name) }}</p>
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('slug', __('messages.blogs_category.slug').':') }}
        <p>{{ html_entity_decode($blog->slug) }}</p>
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        <div class="row">
            <div class="col-12">
                {{Form::label('image', __('messages.blogs_category.hero_image').':') }}
            </div>
            <div class="col-12">
                <img src="{{$blog->image_url ? $blog->image_url : asset('img/infyom-logo.png')}}" class="img-thumbnail thumbnail-preview">
            </div>
        </div>
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('status', __('messages.blogs_category.status').':') }}
        @if($blog->is_published)
            <h6 class="m-0">
                <span class="badge badge-success published-badge">{{__('messages.blogs_category.published')}}</span>
            </h6>
        @else
            <h6 class="m-0">
                <span class="badge badge-info published-badge">{{__('messages.blogs_category.draft')}}</span>
            </h6>
        @endif
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('status', __('messages.blogs_category.featured').':') }}
        @if($blog->is_featured)
            <h6 class="m-0">
                <span class="badge badge-success published-badge">{{__('messages.blogs_category.featured')}}</span>
            </h6>
        @else
            <h6 class="m-0">
                <span class="badge badge-danger published-badge">{{__('messages.blogs_category.not_featured')}}</span>
            </h6>
        @endif
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('created on',__('messages.created_on').':') }}<br>
        <p><span data-toggle="tooltip" data-placement="right"
                 title="{{ date('jS M, Y', strtotime($blog->created_at)) }}">{{ $blog->created_at->diffForHumans() }}</span>
        </p>
    </div>
    <div class="form-group col-xl-4 col-md-4 col-sm-12">
        {{ Form::label('updated on',__('messages.updated_on').':') }}<br>
        <p><span data-toggle="tooltip" data-placement="right"
                 title="{{ date('jS M, Y', strtotime($blog->updated_at)) }}">{{ $blog->updated_at->diffForHumans() }}</span>
        </p>
    </div>
    <div class="form-group col-xl-8 col-md-8 col-sm-12">
        {{ Form::label('body', __('messages.blogs_category.body').':') }}
        <br>{!! $blog->description !!}
    </div>
</div>
