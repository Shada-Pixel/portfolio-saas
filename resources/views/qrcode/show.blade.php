<div class="modal fade p-0" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showModalLabel">{{__('messages.qr_code.view_qr_code')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="showQrCode d-flex justify-content-center user-QrCode"></div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <a type="button" download="qr-code.svg"
                   class="btn btn-primary text-center download-image">{{ __('messages.qr_code.download') }}</a>
            </div>
        </div>
    </div>
</div>
