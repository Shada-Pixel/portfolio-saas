<div class="modal fade p-0" id="achievementModal" tabindex="-1" role="dialog" aria-labelledby="aboutMeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aboutMeModalLabel">{{__('messages.achievement.new_achievement')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(['id' =>'achievementForm','method'=>'post']) }}
                <div class="row">
                    <div class="form-group col-lg-12 col-sm-12">
                        {{ Form::label('title', __('messages.title').':') }}<span class="text-danger">*</span>
                        {{ Form::text('title', null , ['class' => 'form-control','placeholder' => __('messages.achievement.enter_title'),'required']) }}
                    </div>
                    <div class="form-group col-lg-4 col-sm-6">
                        {{ Form::label('icon', __('messages.icon').':') }}<span class="text-danger">*</span><i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip" data-placement="top" title="{{__('messages.achievement.light_mode_icon')}}"></i><br>
                        <button class="btn btn-primary iconpicker dropdown-toggle iconPicker achievement-icon"
                                data-iconset="fontawesome5"
                                data-icon="fas fa-ad" role="iconpicker" data-original-title="" title=""
                                aria-describedby="popover984402" id="defaultIconPicker">
                        </button>
                        <input class="form-control plan-icon achievementIcon" value="fas fa-ad" name="icon" type="text"
                               hidden><br>
                    </div>
                    <div class="form-group col-lg-4 col-sm-6">
                        {{ Form::label('icon', __('messages.achievement.dark_icon').':') }}<span class="text-danger">*</span>
                        <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip" data-placement="top" title="{{__('messages.achievement.dark_mode_icon')}}"></i><br>
                        <button class="btn btn-primary iconpicker dropdown-toggle iconPicker achievement-icon"
                                data-iconset="fontawesome5"
                                data-icon="fas fa-ad" role="iconpicker" data-original-title="" title=""
                                aria-describedby="popover984402" id="defaultDarkIconPicker">
                        </button>
                        <input class="form-control plan-icon achievementDarkIcon" value="fas fa-ad" name="dark_icon" type="text"
                               hidden><br>
                    </div>
                    <div class="form-group col-lg-4 col-sm-6">
                        {{ Form::label('color', __('messages.color').':') }}<span class="text-danger mr-2">*</span>
                        {{ Form::text('color', '#f5365c', ['id' => 'color', 'hidden', 'class' => 'form-control color']) }}
                        <div class="color-wrapper"></div>
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('short description', __('messages.achievement.short_description').':') }}<span
                                class="text-danger">*</span>
                        <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip"
                           data-placement="top" title="{{__('messages.achievement.achievement_description_tooltip')}}"></i>
                        {{__('messages.remaining_characters').':'}} <span id="characterCount"></span>
                        {{ Form::textarea('short_description', null , ['class' => 'form-control','maxlength' => 155 ,'id'=>'description', 'required', 'placeholder' => __('messages.achievement.achievement_description')]) }}
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'achievementSaveBtn', 'data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    {{ Form::button(__('messages.cancel'), ['type' => 'button', 'class' => 'btn btn-light text-dark','data-dismiss'=>'modal']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
