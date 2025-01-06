<div id="changeLanguageModal" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content left-margin">
            <div class="modal-header">
                <h5 class="modal-title">{{__('messages.language.change_language')}}</h5>
                <button type="button" aria-label="Close" class="close" data-dismiss="modal">×</button>
            </div>
            {{ Form::open(['id'=>'changeLanguageForm']) }}
            <div class="modal-body">
                <div class="alert alert-danger d-none" id="editProfileValidationErrorsBox"></div>
                {{csrf_field()}}
                <div class="row">
                    <div class="form-group col-12">
                        {{ Form::label('language',__('messages.language.language').':') }}<span
                                class="required text-danger">*</span>
                        {{ Form::select('language', \App\Models\User::LANGUAGES, Auth::user()->language, ['id'=>'language','class' => 'form-control','required']) }}
                    </div>
                </div>
                <div class="text-right d-flex align-items-center justify-content-end">
                    {{ Form::button(__('messages.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnLanguageChange','data-loading-text'=>"<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                    <button type="button" class="btn btn-light text-dark left-margin" data-dismiss="modal">{{__('messages.cancel')}}
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
