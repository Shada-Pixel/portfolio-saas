<div class="modal fade p-0 hire-me-modal" id="hireMeModal" tabindex="-1" role="dialog"
     aria-labelledby="hireMeModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title " id="hireMeModalLabel"> Hire Me</h4>
                <button type="button" class="{{getSettingValue('theme_layout') == 1 ? 'close': 'btn-close'}}"
                        {{ getSettingValue('theme_layout') == 1 ? 'data-dismiss=modal'  : 'data-bs-dismiss=modal' }} aria-label="Close">
                    {!!  getSettingValue('theme_layout') == 1 ? '<span aria-hidden="true">&times;</span>' : ''  !!}
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(['id' =>'hireMeForm','method'=>'post', 'autocomplete'=>'off']) }}
                <div class="row">
                    <div class="form-group col-lg-4 col-12">
                        {{ Form::label('name', 'Name:') }}<span class="text-danger">*</span>
                        {{ Form::text('name', null , ['class' => 'form-control','placeholder' => 'Enter Name','required']) }}
                    </div>
                    <div class="form-group col-lg-4 col-12">
                        {{ Form::label('email', 'Email:') }}<span class="text-danger">*</span>
                        {{ Form::email('email', null , ['class' => 'form-control','placeholder' => 'Enter Email','required']) }}
                    </div>
                    <div class="form-group col-lg-4 col-12">
                        {{ Form::label('mobile', 'Mobile:') }}
                        {{ Form::text('mobile', null,['class' => 'form-control', 'onkeyup' => 'if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,"")','id'=>'phoneNumber','placeholder' => 'Enter Mobile Number','minlength'=> '10','maxlength'=> '10']) }}
                        {{--                    {{ Form::hidden('region_code',null,['id'=>'prefix_code']) }}--}}
                        {{--                    <span id="valid-msg" class="hide">✓ &nbsp; Valid</span>--}}
                        {{--                    <span id="error-msg" class="hide"></span>--}}
                    </div>
                    <div class="form-group col-lg-4 col-12">
                        {{ Form::label('company_name', 'Company Name:') }}<span class="text-danger">*</span>
                        {{ Form::text('company_name', null , ['class' => 'form-control','placeholder' => 'Enter Company Name','required']) }}
                    </div>
                    <div class="form-group col-lg-4 col-12">
                        {{ Form::label('interested in', 'Interested In:') }}<span class="text-danger">*</span>
                        {{ Form::text('interested_in', null , ['class' => 'form-control','placeholder' => 'Enter Interest','required']) }}
                    </div>
                    <div class="form-group col-lg-4 col-12">
                        {{ Form::label('budget', 'Budget:') }}<span class="text-danger">*</span>
                        {{ Form::text('budget', null , ['class' => 'form-control price-input','placeholder' => 'Enter Budget', 'required', 'maxlength' => 6]) }}
                    </div>
                    <div class="form-group col-12">
                        {{ Form::label('message', 'Message:') }}<span class="text-danger">*</span>
                        {{ Form::textarea('message', null , ['class' => 'form-control','id'=>'message','placeholder' => 'Enter Message']) }}
                    </div>
                </div>
                {{ Form::button('Save', ['type' => 'submit', 'class' => 'btn hire-me-btn', 'id' => 'hireMeSaveBtn', 'data-loading-text' => "<span class='spinner-border spinner-border-sm'></span> Processing..."]) }}
                <button type="button" name="Cancel"
                        class="btn hire-me-cancel-btn text-dark" {{ getSettingValue('theme_layout') == 1 ? 'data-dismiss=modal'  : 'data-bs-dismiss=modal' }}>
                    Cancel
                </button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
