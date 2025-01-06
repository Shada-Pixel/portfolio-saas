@extends('layouts.app')
@section('title')
    {{__('messages.dashboard.dashboard')}}
@endsection
@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">{{__('messages.dashboard.dashboard')}}</h6>
                    </div>
                </div>
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">{{__('messages.dashboard.active_users')}}</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$data['activeUsers']}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-indigo text-success rounded-circle shadow">
                                            <i class="fa fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">{{__('messages.dashboard.deactive_users')}}</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$data['deActiveUsers']}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-default text-danger rounded-circle shadow">
                                            <i class="fa fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">{{__('messages.dashboard.freelancer_users')}}</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $data['freelancersUsers']}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-gray-dark text-white rounded-circle shadow">
                                            <i class="fas fa-briefcase"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">{{__('messages.published_blogs')}}</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$data['publishedBlogs']}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-translucent-primary text-black-50 rounded-circle shadow">
                                            <i class="fas fa-blog"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">{{__('messages.dashboard.featured_blogs')}}</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$data['featuredBlogs']}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-translucent-success text-blue rounded-circle shadow">
                                            <i class="fab fa-blogger-b"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">{{__('messages.enquires')}}</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$data['enquiries']}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-translucent-info text-white rounded-circle shadow">
                                            <i class="fas fas fa-question-circle"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">{{__('messages.pricing_plans')}}</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$data['pricingPlans']}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            <i class="fas fa-hand-holding-usd"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">{{__('messages.testimonials')}}</h5>
                                        <span class="h2 font-weight-bold mb-0">{{$data['testimonials']}}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                            <i class="ni ni-chart-bar-32"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">{{__('messages.enquires')}}</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{route('admin.enquiries.index')}}"
                                   class="btn btn-sm btn-primary {{ count($data['Enquiries'])===0? 'd-none': '' }}">{{__('messages.dashboard.see_all')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">{{__('messages.full_name')}}</th>
                                <th scope="col">{{__('messages.email')}}</th>
                                <th scope="col">{{__('messages.admin_users.phone')}}</th>
                                <th scope="col">{{__('messages.enquiries.status')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data['Enquiries'] as $enquiry)
                                <tr>
                                    <th scope="row">
                                        <a href="{{getLoggedInUser()->hasRole('super_admin') ? route('admin.enquiries.show', $enquiry->id) : ''}}" class="text-blue">
                                            {{$enquiry->full_name}}</a>
                                        
                                    </th>
                                    <td>
                                        {{$enquiry->email}}
                                    </td>
                                    <td>
                                        {{$enquiry->phone}}
                                    </td>
                                    <td>
                                        <h5>
                                            <span class="badge badge-lg {{$enquiry->status == \App\Models\AdminEnquiry::READ ? 'badge-primary' : 'badge-danger'}}">{{\App\Models\AdminEnquiry::STATUS_ARR[$enquiry->status]}}</span>
                                        </h5>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <span>{{__('messages.dashboard.not_available_enquiries')}}</span>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">{{__('messages.users')}}</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{route('users.index')}}"
                                   class="btn btn-sm btn-primary {{ count($data['users']) == 0? 'd-none': '' }}">{{__('messages.dashboard.see_all')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">{{__('messages.full_name')}}</th>
                                <th scope="col">{{__('messages.admin_users.email')}}</th>
                                <th scope="col">{{__('messages.created_on')}}</th>
                                <th scope="col">{{__('messages.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data['users'] as $users)
                                <tr>
                                    <th scope="row">
                                        
                                        <a href="{{route('users.show', $users->id)}}" class="text-blue"> 
                                            {{$users->full_name}} </a>
                                    </th>
                                    <td>
                                        {{$users->email}}
                                    </td>
                                    <td>
                                        {{ $users->created_at->diffForHumans() }}
                                    </td>
                                    <td class="text-center">
                                        @if($users->status == \App\Models\User::ACTIVE)
                                            <a href="{{route('portfolio.front', $users->user_name)}}" class="show-btn" target="_blank">
                                                <i class="fas fa-eye card-view-icon"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">
                                        <span>{{__('messages.dashboard.not_available_users')}}</span>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
