@extends('layouts.app')
@section('title')
{{__('messages.testimonials')}}
@endsection
@section('css')
    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 custom-testimonials">
                    <div class="col-lg-6 col-7 custom-test-text">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.testimonials')}}</h6>
                    </div>
                    <div class="col-lg-6 col-5 text-right custom-test-btn">
                        <a href="#" class="btn btn-group-lg btn-neutral addModalTestimonial testimonials-btn">{{__('messages.new_testimonial')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="card mb-4">
            <div class="card-body">
                @include('testimonials.table')
            </div>
        </div>
        @include('testimonials.templates.templates')
        @include('testimonials.create_model')
        @include('testimonials.edit_model')
        @include('testimonials.show_model')
    </div>
@endsection
@section('scripts')
    <script>
        let testimonialDescription = '{{__('messages.testimonial_placeholder.testimonial_description')}}'; 
    </script>
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{mix('assets/js/testimonial/testimonial.js')}}"></script>
@endsection

