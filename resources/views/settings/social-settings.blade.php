@extends('settings.index')
@section('title')
{{__('messages.social_settings')}}
@endsection
@section('section')
    {{ Form::open(['route' => [getLoggedInUser()->hasRole('super_admin') ? 'admin.settings.update.social' : 'settings.update.social'],'method'=>'post','id'=>'editSetting']) }}
    {{ Form::hidden('sectionName', $sectionName) }}
    @method('PUT')
        
    @if(getLoggedInUser()->hasRole('super_admin'))
        <div class="row">   
            <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="form-group">
                    {{ Form::label('s6_text_title', __('messages.front_side_cms.s6_text_title').':') }}<span
                            class="text-danger">*</span>
                    {{ Form::text('s6_text_title', $sectionSix['s6_text_title'], ['class' => 'form-control','placeholder' => __('messages.front_side_cms.s6_text_title'), 'required', 'maxlength' => 30]) }}
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12 col-12">
                <div class="form-group">
                    {{ Form::label('s6_text_secondary', __('messages.front_side_cms.s6_text_secondary').':') }}<span
                            class="text-danger">*</span>
                    {{ Form::text('s6_text_secondary', $sectionSix['s6_text_secondary'], ['class' => 'form-control','placeholder' => __('messages.front_side_cms.s6_text_secondary'), 'required', 'maxlength' => 100]) }}
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <table class="table table-bordered table-responsive-sm" id="socialSettingTbl">
            <thead class="">
            <tr>
                {{--                <th class="text-center" width="5%">#</th>--}}
                <th class="text-center text-dark" width="1%">{{__('messages.social_icon')}}
                </th>
                <th class="plan-attribute-filed">{{__('messages.link')}}</th>
                {{--                <th width="1%">--}}
                {{--                    <button type="button" class="btn btn-sm btn-primary float-right w-100"--}}
                {{--                            id="addItem">{{ __('Add') }}</button>--}}
                {{--                </th>--}}
            </tr>
            </thead>
            <tbody class="social-setting-container">
            @forelse($settings as $key => $setting)
                <tr>
{{--                    <td class="text-center item-number">{{$key+1}}</td>--}}
                    <td class="text-center align-middle">
                        <button class="btn btn-primary  iconpicker button-icon-size dropdown-toggle editSocialSettingIcon mr-0"
                                data-iconset="fontawesome5"
                                data-icon="{{$setting->key}}" role="iconpicker" data-original-title="" title=""
                                aria-describedby="popover984402" data-id="{{$key+1}}">
                        </button>
                        <input class="form-control edit-social-setting-icon{{$key+1}}" name="key[]" type="text" hidden
                               value="{{$setting->key}}">
                    </td>
                    <td>
                        <input class="form-control" name="value[]" type="text" value="{{$setting->value}}" placeholder="{{__('messages.settings_placeholder.enter_link')}}">
                    </td>
                    {{--                    <td class="text-center">--}}
                    {{--                        <i class="fa fa-trash text-danger delete-social-icon pointer"></i>--}}
                    {{--                    </td>--}}
                </tr>
            @empty
            @endforelse
            </tbody>
        </table>


        <div class="form-group col-sm-12 mt-3 p-0">
            {{ Form::button(__('messages.save'), ['type'=>'submit','class' => 'btn btn-primary','id'=>'btnSave','data-loading-text'=>"<span class='spinner-b order spinner-border-sm'></span> Processing..."]) }}
        </div>
    </div>

    {{ Form::close() }}
@endsection
