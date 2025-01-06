<div class="row details-page">
    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('s3_text_title', __('messages.front_side_cms.s3_text_title').':') }}
        <p>{{ $sectionThreeFront['s3_text_title'] }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('Image', __('messages.image').':') }}
        <br><img src="{{ $sectionThreeFront['s3_image_main'] }}" height="50" width="50" alt="">
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('image_url', __('messages.front_side_cms.s3_image_one').':') }}
        <br><img src="{{ $sectionThree->image_url }}" height="50" width="50" alt="">
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('image_text', __('messages.front_side_cms.s3_image_text_one').':') }}
        <p>{{ $sectionThree->image_text }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('image_text_secondary', __('messages.front_side_cms.s3_image_text_one_secondary').':') }}
        <p>{{ $sectionThree->image_text_secondary }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('created_at', __('messages.created_on').':') }}
        <p><span data-toggle="tooltip" data-placement="right"
                 title="{{ date('jS M, Y', strtotime($sectionThree->created_at)) }}">{{ $sectionThree->created_at->diffForHumans() }}</span>
        </p>
    </div>
    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('updated_at', __('messages.last_updated').':') }}
        <p><span data-toggle="tooltip" data-placement="right"
                 title="{{ date('jS M, Y', strtotime($sectionThree->updated_at)) }}">{{ $sectionThree->updated_at->diffForHumans() }}</span>
        </p>
    </div>

    <div class="form-group col-xl-12 col-lg-12 col-md-6 col-sm-12">
        {{ Form::label('slider_text', __('messages.front_side_cms.s3_text_slider_one').':') }}
        <p>{!! $sectionThree->slider_text !!}</p>
    </div>
</div>
