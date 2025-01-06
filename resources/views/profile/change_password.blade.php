<div id="changePasswordModal" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('messages.user.change_password')}}</h5>
                <button type="button" aria-label="Close" class="close outline-none" data-dismiss="modal">×</button>
            </div>
            <form method="POST" id="changePasswordForm">
                <div class="modal-body">
                    <div class="alert-danger alert d-none" id="editValidationErrorsBox"></div>
                    @csrf
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>{{__('messages.user.current_password')}}</label><span
                                    class="required confirm-pwd"></span><span class="text-danger">*</span>
                            <div class="input-group">
                                <input class="form-control input-group__addon password" id="pfCurrentPassword"
                                       type="password"
                                       name="password_current" required placeholder="{{__('messages.change_password_placeholder.enter_current_password')}}">
                                <div class="input-group-append input-group__icon">
                                <span class="input-group-text changeType">
                                    <i class="fas fa-eye-slash"></i>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label>{{__('messages.user.new_password')}}</label><span
                                    class="required confirm-pwd"></span><span class="text-danger">*</span>
                            <div class="input-group">
                                <input class="form-control input-group__addon password" id="pfNewPassword"
                                       type="password"
                                       name="password" required placeholder="{{__('messages.change_password_placeholder.enter_new_password')}}">
                                <div class="input-group-append input-group__icon">
                                <span class="input-group-text changeType">
                                    <i class="fas fa-eye-slash"></i>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label>{{__('messages.user.confirm_password')}}</label><span
                                    class="required confirm-pwd"></span><span class="text-danger">*</span>
                            <div class="input-group">
                                <input class="form-control input-group__addon password" id="pfNewConfirmPassword"
                                       type="password"
                                       name="password_confirmation" required placeholder="{{__('messages.change_password_placeholder.enter_confirm_password')}}">
                                <div class="input-group-append input-group__icon">
                                <span class="input-group-text changeType">
                                    <i class="fas fa-eye-slash"></i>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary" id="btnPrPasswordEditSave"
                                data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">
                            {{__('messages.save')}}
                        </button>
                        <button type="button" class="btn btn-light ml-1 text-dark" data-dismiss="modal">{{__('messages.cancel')}}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
