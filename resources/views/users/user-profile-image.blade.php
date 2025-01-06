<div class="row user-profile-row">
    <div class="col-sm-6">
        <div class="form-group {{ getLoggedInUser()->hasRole('super_admin') ? 'col-sm-12 d-flex justify-content-end' : 'col-sm-12 d-flex justify-content-center child-user-row' }}">
            <div class="card-user-image">
                {{ Form::open(['method'=>'post','files' => true,'id'=>'profileImageUpdate']) }}
                <img src="{{auth()->user()->profile_image}}" class="rounded-circle" id="profilePreview">
                {{ Form::file('profile_image',['id'=>'icon','class' => 'profile_image','accept'=>'image/jpg,image/jpeg,image/png,image/gif', 'title'=> '']) }}
                <i class="fas fa-camera"></i>
                {{ Form::close() }}
            </div>
        </div>
        <div class="text-center">
            <h1 class="text-primary mt-3 ml-3">{{$user->first_name}} {{$user->last_name}}</h1>
            <span class="text-gray ml-3">{{$user->email}}</span><br>
            <span class="text-gray ml-3">{{$user->job_title}}</span>
        </div>
    </div>
    <div class="col-sm-6 d-flex justify-content-center mt-sm-0 mt-3">
        {!! QrCode::size(200)->generate(url('p'.DIRECTORY_SEPARATOR.getLoggedInUser()->user_name)); !!}
    </div>

</div><br>
