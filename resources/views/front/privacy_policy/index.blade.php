@extends('layouts.front.app')
@section('title')
    {{ __('messages.privacy_policy') }}
@endsection
@section('content')
    <section id="content">
        <div class="content-wrap p-0 section-content">
            <div class="title-heading-bg">
                <div class="container py-3">
                    <h1 class="title-gradient my-0">{{ __('messages.privacy_policy') }}</h1>
                </div>
            </div>
            <div class="container mt-3">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        {!! getAdminSettingValue('privacy_policy') !!}
                    </div>
                </div>
            </div>

            <div class="clear"></div>
        </div>

    </section>
@endsection
