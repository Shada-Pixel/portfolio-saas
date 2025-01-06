<div class="row">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                {{ Form::label('name', __('messages.qr_code.qr_code_generator')) }}
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-12">
                        {{ Form::label('url', __('messages.vCards.url').':') }}<span class="text-danger">*</span>
                        {{ Form::text('url', $qrCode->url, ['class' => 'form-control','placeholder' => __('messages.vCards.vCards_placeholder.enter_value'), 'id' => 'url','maxlength' => 100,'required']) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('name', __('messages.name').':') }}<span class="text-danger">*</span>
                        {{ Form::text('name', $qrCode->name , ['class' => 'form-control','placeholder' => __('messages.vCards.vCards_placeholder.enter_name'),'maxlength' => 30,'required']) }}
                    </div>
                    <div class="form-group col-sm-6">
                        {{ Form::label('color', __('messages.color').':') }}
                        <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip"
                           data-placement="top" title="{{__('messages.qr_code.color_text')}}"></i>
                        <div class="color-wrapper"></div>
                        {{ Form::text('color', $qrCode->color, ['id' => 'color', 'hidden', 'class' => 'form-control color editColor']) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('size', __('messages.qr_code.size').':') }}
                        {{ Form::range('size', $qrCode->size, ['class' => 'form-control-range','id' => 'size', 'min' => 200, 'max' => 350]) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('white_space', __('messages.qr_code.white_space').':') }}
                        {{ Form::range('white_space', $qrCode->white_space , ['class' => 'form-control-range','id' => 'whiteSpace',  'min' => 1, 'max' => 5]) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('style', __('messages.qr_code.style').':') }}
                        {{ Form::select('style', $style, $qrCode->style, ['id'=>'style','class' => 'form-control']) }}
                    </div>
                    <div class="form-group col-md-6">
                        {{ Form::label('eye_style', __('messages.qr_code.eye_style').':') }}
                        {{ Form::select('eye_style', $eyeStyle, $qrCode->eye_style, ['id'=>'eyeStyle','class' => 'form-control']) }}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="form-group col-sm-12 mt-3 d-flex align-items-center">
                    {{ Form::button(__('messages.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <a href="{{ route('qrcodes.index') }}"
                       class="btn text-dark btn-light ml-1">{{__('messages.cancel')}}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="row">
            <div class="card w-100">
                <div class="card-header">
                    {{ Form::label('name', __('messages.vCards.preview')) }}
                    {{ Form::button(__('messages.qr_code.clear'), ['type'=>'button','class' => 'btn btn-primary float-right clear-image','id'=>'clearImage']) }}
                </div>
                <div class="card-body text-center">
                    <div id="userQrCode" class="user-QrCode">
                        <?php
                        $replaceColor = str_replace(['rgba(', ')'], '', $qrCode->color);
                        $explodeColor = explode(',', $replaceColor);
                        ?>
                        {{ QrCode::size($qrCode->size)->margin($qrCode->white_space)->style($qrCode->style)->eye($qrCode->eye_style)->color($explodeColor[0], $explodeColor[1], $explodeColor[2])->generate($qrCode->url)}}
                    </div>
                </div>
                <div class="card-footer text-center">
                    <a type='button' download="qr-code.svg" class="btn btn-primary text-white download-image"
                       href="data:image/svg+xml;base64, {{base64_encode( QrCode::size($qrCode->size)->margin($qrCode->white_space)->style($qrCode->style)->eye($qrCode->eye_style)->color($explodeColor[0], $explodeColor[1], $explodeColor[2])->format('svg')->generate($qrCode->url))}}">{{ __('messages.qr_code.download_image') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
