<div class="row details-page">
    <div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-12">
        {{ Form::label('s4_text_title', __('messages.front_side_cms.s3_text_title').':') }}
        <p>{{ $sectionFourFront['s4_text_title'] }}</p>
    </div>

    <div class="form-group col-xl-3 col-lg-3 col-md-6 col-sm-12">
        {{ Form::label('s3_text_title', __('messages.front_side_cms.s4_text_secondary').':') }}
        <p>{{ $sectionFourFront['s4_text_secondary'] }}</p>
    </div>

    <div class="form-group col-xl-2 col-lg-2 col-md-6   col-sm-12">
        {{ Form::label('image_url', __('messages.front_side_cms.s3_image_one').':') }}
        <br><img src="{{ $sectionFour->image_url }}" height="50" width="50" alt="">
    </div>
    <div class="form-group col-xl-2 col-lg-2 col-md-6 col-sm-12">
        {{ Form::label('color', __('messages.color').':') }}
        @php
            $inStyle = 'style';
            $color = 'background:'.$sectionFour->color.';height:50px'.';width:50px';
        @endphp
        <p {{ ($sectionFour->color == '#FFFFFF') ? $inStyle."=background:#f5365c;height:50px;width:50px;" : $inStyle.'='.$color }}></p>
    </div>
    <div class="form-group col-xl-2 col-lg-2 col-md-6 col-sm-12">
        {{ Form::label('image_text', __('messages.front_side_cms.s3_image_text_one').':') }}
        <p>{{ $sectionFour->image_text }}</p>
    </div>

    <div class="form-group col-xl-12 col-lg-12 col-md-6 col-sm-12">
        {{ Form::label('slider_text', __('messages.front_side_cms.s3_text_slider_one').':') }}
        <p>{!! $sectionFour->image_text_description !!}</p>
    </div>
    
    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('created_at', __('messages.created_on').':') }}
        <p><span data-toggle="tooltip" data-placement="right"
                 title="{{ date('jS M, Y', strtotime($sectionFour->created_at)) }}">{{ $sectionFour->created_at->diffForHumans() }}</span>
        </p>
    </div>
    <div class="form-group col-xl-3 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('updated_at', __('messages.last_updated').':') }}
        <p><span data-toggle="tooltip" data-placement="right"
                 title="{{ date('jS M, Y', strtotime($sectionFour->updated_at)) }}">{{ $sectionFour->updated_at->diffForHumans() }}</span>
        </p>
    </div>
</div>
