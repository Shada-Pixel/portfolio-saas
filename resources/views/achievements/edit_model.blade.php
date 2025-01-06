<div class="modal fade p-0" id="editModal" tabindex="-1" role="dialog" aria-labelledby="aboutMeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aboutMeModalLabel">{{__('messages.achievement.edit_achievement')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="editValidationErrorsBox"></div>
                {{ Form::open(['id' =>'editAchievementForm','method'=>'post']) }}
                {{ Form::hidden('id',null,['id' => 'achievementId']) }}
                <div class="row">
                    <div class="form-group col-lg-12 col-sm-12">
                        {{ Form::label('title', __('messages.title').':') }}<span class="text-danger">*</span>
                        {{ Form::text('title', null , ['class' => 'form-control','id'=>'editTitle','required', 'placeholder' => __('messages.achievement.enter_title')]) }}
                    </div>
                    <div class="form-group col-lg-4 col-sm-6">
                        {{ Form::label('icon', __('messages.icon').':') }}<span class="text-danger ml-2">*</span><i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip" data-placement="top" title="{{__('messages.achievement.light_mode_icon')}}"></i><br>
                        <button class="btn btn-primary iconpicker dropdown-toggle  editIcon achievement-icon"
                                data-iconset="fontawesome5" data-icon="" role="iconpicker" data-original-title=""
                                title=""
                                aria-describedby="popover984402" id="editDefaultIconPicker">
                        </button>
                        <input class="form-control plan-icon editAchievementIcon" name="icon" type="text" value=""
                               hidden><br>
                    </div>
                    <div class="form-group col-lg-4 col-sm-6">
                        {{ Form::label('icon', __('messages.achievement.dark_icon').':') }}<span class="text-danger">*</span>
                        <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip" data-placement="top" title="{{__('messages.achievement.dark_mode_icon')}}"></i><br>
                        <button class="btn btn-primary iconpicker dropdown-toggle editIcon achievement-icon"
                                data-iconset="fontawesome5"
                                data-icon="" role="iconpicker" data-original-title="" title=""
                                aria-describedby="popover984402" id="editDefaultDarkIconPicker">
                        </button>
                        <input class="form-control plan-icon editAchievementDarkIcon" value="" name="dark_icon" type="text"
                               hidden><br>
                    </div>
                    <div class="form-group col-lg-4 col-sm-6">
                        {{ Form::label('color', __('messages.color').':') }}<span class="text-danger ml-2">*</span>
                        {{ Form::text('color', '', ['id' => 'edit_color', 'hidden', 'class' => 'form-control color']) }}
                        <div class="edit-color-wrapper"></div>
                    </div>
                    <div class="form-group col-sm-12">
                        {{ Form::label('short description', __('messages.achievement.short_description').':') }}<span
                                class="text-danger">*</span>
                        <i class="fas fa-question-circle ml-1 mt-1 general-question-mark" data-toggle="tooltip"
                           data-placement="top" title="{{__('messages.achievement.achievement_description_tooltip')}}"></i>
                        {{__('messages.remaining_characters').':'}} <span id="editCharacterCount"></span>
                        {{ Form::textarea('short_description', null , ['class' => 'form-control','maxlength' => 155 ,'id'=>'editDescription', 'required', 'placeholder' => __('messages.achievement.achievement_description')]) }}
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    {{ Form::button(__('messages.save'), ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'editAchievementSaveBtn', 'data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    {{ Form::button(__('messages.cancel'), ['type' => 'button', 'class' => 'btn btn-light text-dark','data-dismiss'=>'modal']) }}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

