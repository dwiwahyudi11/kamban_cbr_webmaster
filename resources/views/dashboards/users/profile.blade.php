@extends('dashboards.app')

@section('title', 'Profil')

@section('content')
<div class="section-header">
    <h1>Profile</h1>
</div>

<div class="section-body">
    {!! Form::model($user, ['method' => 'PATCH', 'route' => ['dashboard.profile.update', $user->id], 'files'=> true, 'autocomplete'=>'off', 'class'=> 'needs-validation', 'novalidate'=> '']) !!}
    <div class="row row mt-sm-4">
        
        <div class="col-md-4">
            <div class="card card-profile-widget p-3">
                <div class="profile-widget-header text-center">
                    @if($user->avatar)
                        <img src="{{ asset('uploads/avatars/'. $user->avatar) }}" alt="{{ $user->name }}" id="avatar-image" class="img-fluid rounded-circle profile-widget-picture">
                    @else
                        <img src="{{ asset('images/avatar-1.png') }}" alt="{{ $user->name }}" id="avatar-image" class="img-fluid rounded-circle profile-widget-picture">
                    @endif
                </div>
                <div class="profile-widget-description mt-3">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="avatar" name="avatar" accept="image/*">
                      <label class="custom-file-label" for="avatar">Choose file</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Profile</h4>
                </div>
                <div class="card-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br>
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="name">Full Name</label>
                            {!! Form::text('name', null, array('id' => 'name', 'placeholder' => 'Full Name', 'class' => 'form-control', 'required', 'autofocus')) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="email">Email</label>
                            {!! Form::text('email', null, array('id' => 'email', 'placeholder' => 'Email', 'class' => 'form-control', 'required')) !!}
                        </div>
                    </div>

                    {{-- <div class="row">
                        <div class="form-group col-12">
                            <label for="email">Level</label>
                            <div>
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $role)
                                        <span class="badge badge-primary">{{ ucwords($role) }}</span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div> --}}

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="password">New Password</label>
                            {!! Form::password('password', array('id' => 'password', 'placeholder' => 'Password', 'class' => 'form-control pwstrength', 'data-indicator' => 'pwindicator')) !!}
                            <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-12">
                            <label for="confirm-password">Confirm Password</label>
                            {!! Form::password('confirm-password', array('id' => 'confirm-password', 'placeholder' => 'Confirm Password', 'class' => 'form-control')) !!}
                        </div>
                    </div>
                
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-lg btn-primary">Update Profile</button>
                </div>
            </div>

        </div>

    </div>
    {!! Form::close() !!}
</div>
@endsection

@section('javascript')
    <script src="{{ asset('modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script type="text/javascript">
    $(function(){
        @if ($message = Session::get('success'))
            toastr.success('{{ $message }}', 'Success');
        @endif

        $(".pwstrength").pwstrength();

        $('#avatar').on("change", function(){
            var $avatar = $('#avatar-image');

            if ( this.files && this.files[0] ) 
            {
                var $filename = this.files[0].name;
                filesize = this.files[0].size;

                var FR = new FileReader();

                FR.onerror = function(e) {
                    switch(e.target.error.code) {
                        case e.target.error.NOT_FOUND_ERR:
                            alert('File Not Found!');
                            break;
                        case e.target.error.NOT_READABLE_ERR:
                            alert('File is not readable');
                            break;
                        case e.target.error.ABORT_ERR:
                            break;
                            default:
                            alert('An error occurred reading this file.');
                    };
                }

                FR.onload = function(e) {
                    var image = new Image();
                    image.src = FR.result;

                    image.onload = function(){
                        var $image_width = image.width;
                        var $image_height = image.height;

                        $avatar.attr('src', e.target.result);
                    }
                }
                FR.readAsDataURL( this.files[0] );
            }
        });
    });
    </script>
@endsection