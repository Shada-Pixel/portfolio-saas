<div class="modal fade p-0" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel">{{__('messages.achievement.achievement_details')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(['id' => 'showForm']) }}
                <div class="row details-page">
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 col-12">
                        {{ Form::label('title',__('messages.title').':') }}<br>
                        <span id="showTitle"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 col-12">
                        {{ Form::label('icon',__('messages.icon').':') }}<br>
                        <span id="showIcon"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 col-12">
                        {{ Form::label('icon',__('messages.achievement.dark_icon').':') }}<br>
                        <span id="showDarkIcon"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 col-12">
                        {{ Form::label('messages.create',__('messages.color').':') }}<br>
                        @php
                            $inStyle = 'style';
                            $color = "height:50px;width:50px";
                        @endphp
                        <p class="showColor" {{$inStyle.'='.$color}}></p>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 col-12">
                        {{ Form::label('created on',__('messages.created_on').':') }}<br>
                        <span id="showCreatedOn"></span>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-6 col-12">
                        {{ Form::label('updated on',__('messages.last_updated').':') }}<br>
                        <span id="showUpdatedOn"></span>
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('description',__('messages.achievement.short_description').':') }}<br>
                        <span class="custom-description" id="showDescription"></span>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
