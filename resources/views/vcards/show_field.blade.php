<div class="row details-page">
    <div class="form-group col-md-12">
        {{ Form::label('template', __('messages.vCards.template').':') }}
    </div>
    <div class="form-group col-xl-12 col-lg-4 col-md-6 col-sm-12">
        @if($vCard->template_id  == 1)
            <img src="{{ asset('assets/web/css/images/vCard-template-one.png') }}" class="img-thumbnail"
                 alt="Template 1">
        @elseif($vCard->template_id == 2)
            <img src="{{ asset('assets/web/css/images/vCard-template-Two.png') }}" class="img-thumbnail"
                 alt="Template 2">
        @elseif($vCard->template_id == 3)
            <img src="{{ asset('assets/web/css/images/vCard-template-Three.png') }}" class="img-thumbnail"
                 alt="Template 2">
        @elseif($vCard->template_id == 4)
            <img src="{{ asset('assets/web/css/images/vCard-template-Four.png') }}" class="img-thumbnail"
                 alt="Template 2">
        @elseif($vCard->template_id == 5)
            <img src="{{ asset('assets/web/css/images/vCard-template-Five.png') }}" class="img-thumbnail"
                 alt="Template 2">
        @endif
    </div>

    <div class="form-group col-xl-4 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('v_card_name', __('messages.vCards.v_card_name').':') }}
        <p>{{ html_entity_decode($vCard->v_card_name) }}</p>
    </div>

    <div class="form-group col-xl-4 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('name', __('messages.name').':') }}
        <p>{{ html_entity_decode($vCard->name) }}</p>
    </div>
    <div class="form-group col-xl-4 col-lg-4 col-md-6 col-sm-12">
        {{ Form::label('occupation', __('messages.vCards.occupation').':') }}
        <p>{{ html_entity_decode($vCard->occupation) }}</p>
    </div>
    <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12">
        {{ Form::label('Introduction', __('messages.vCards.introduction').':') }}
        <p>{!!  html_entity_decode($vCard->introduction) !!}</p>
    </div>
    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
        {{ Form::label('profile_image', __('messages.profile').':') }}
        <br><img class="img-thumbnail thumbnail-preview"
                 src="{{ !empty($vcard->profile_image) ? $vcard->profile_image :  $user->profile_image }}"
                 alt="">
    </div>
    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
        {{ Form::label('cover_image', __('messages.vCards.cover_image').':') }}
        <br><img class="img-thumbnail thumbnail-preview"
                 src="{{ !empty($vCard->cover_image) ? $vCard->cover_image : asset('img/infyom-logo.png')}}"
                 alt="">
    </div>
    <div class="col-sm-12 mt-3">
        <div class="mb-1 form-group">
            {{ Form::label('vCard attribute', __('messages.vCards.v_card_attribute').':') }}
        </div>
        <table class="table table-bordered table-responsive-sm">
            <thead class="text-center">
            <tr>
                <th>{{__('messages.vCards.Icons')}}
                </th>
                <th>{{__('messages.vCards.color')}}
                </th>
                <th>{{__('messages.vCards.label')}}
                </th>
                <th>{{__('messages.vCards.url')}}
                </th>
            </tr>
            </thead>
            <tbody class="plan-attribute-container">
            @forelse($vCard->vCardAttributes as $vCardAttribute)
                <tr>
                    <td class="text-center">
                        @if($vCardAttribute->icon == 'empty')
                            <p>{{__('messages.n/a')}}</p>
                        @else
                            <i class="{{$vCardAttribute->icon}} about-me-font-icon"></i>
                        @endif
                    </td>
                    <td>
                        @php
                            $inStyle = 'style';
                            $color = 'background:'.$vCardAttribute->icon_color.';height:50px'.';width:50px';
                        @endphp
                        <div class="d-flex justify-content-center">
                            <p {{ ($vCardAttribute->icon_color == '#FFFFFF') ? $inStyle."=background:#f5365c;height:50px;width:50px;" : $inStyle.'='.$color }}></p>
                        </div>
                    </td>
                    <td class="text-center">
                        {{$vCardAttribute->label_text}}
                    </td>
                    <td class="text-center">
                        {{$vCardAttribute->value_text}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" align="center">{{__('messages.no_available_attribute')}}</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
