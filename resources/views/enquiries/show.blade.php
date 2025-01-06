@extends('layouts.app')
@section('title')
{{__('messages.enquiries.enquiry_details')}}
@endsection
@section('css')
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 custom-enquiries">
                    <div class="col-lg-6 col-7 enquiries-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.enquiries.enquiry_details')}}
                        </h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right custom-enquires-btn">
                        @role('super_admin')
                        <a href="{{route('admin.enquiries.index')}}"
                           class="btn btn-group-lg btn-neutral enquires-btn2">{{__('messages.back')}}</a>
                        @else
                            <a href="{{route('enquiries.index')}}"
                               class="btn btn-group-lg btn-neutral enquires-btn2">{{__('messages.back')}}</a>
                            @endrole
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--6">
        <div class="card mb-4">
            <div class="card-body">
                @include('enquiries.show_fields')
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@endsection
