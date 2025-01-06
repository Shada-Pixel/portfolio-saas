@extends('layouts.app')
@section('title')
    {{__('messages.featured_portfolio.portfolio')}}
@endsection
@section('css')
    <link href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4 d-flex featured-alignment">
                    <div class="col-lg-6 col-7 featured-title">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.featured_portfolio.portfolio')}}</h6>
                    </div>
                    <div class="ml-auto text-center featured-btn mt-2rem">
                        {{ Form::select('is_portfolio_featured', $isPortfolioFeatured, null, ['id' => 'isPortfolioFeatured', 'class' => 'form-control', 'placeholder' => 'Select Featured' ]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--6">
        <div class="card mb-4">
            <div class="card-body">
                @include('flash::message')
                @include('layouts.errors')
                @include('front.featured_portfolio.table')
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ mix('assets/js/custom/custom-datatable.js') }}"></script>
    <script src="{{ mix('assets/js/front/featured_portfolio/featured_portfolio.js') }}"></script>
@endsection
