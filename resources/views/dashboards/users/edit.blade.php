@extends('dashboards.app')

@section('title', 'Edit Administrator')

@section('styles')
<link rel="stylesheet" href="{{ asset('modules/select2/css/select2.min.css') }}">
@endsection

@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('dashboard.users.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Edit Administrator</h1>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">

            {!! Form::model($user, ['method' => 'PATCH', 'route' => ['dashboard.users.update', $user->id], 'autocomplete'=>'off', 'class'=> 'needs-validation', 'novalidate'=> '']) !!}
            <div class="card">
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

                    <div class="form-group row">
                        <label for="name" class="col-sm-3 col-form-label">Full Name</label>
                        <div class="col-sm-9">
                            {!! Form::text('name', null, array('id' => 'name', 'placeholder' => 'Real Name', 'class' => 'form-control', 'required', 'autofocus')) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            {!! Form::text('email', null, array('id' => 'email', 'placeholder' => 'Email', 'class' => 'form-control', 'required')) !!}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            {!! Form::password('password', array('id' => 'password', 'placeholder' => 'Password', 'class' => 'form-control pwstrength', 'data-indicator' => 'pwindicator')) !!}
                            <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="confirm-password" class="col-sm-3 col-form-label">Confirm Password</label>
                        <div class="col-sm-9">
                            {!! Form::password('confirm-password', array('id' => 'confirm-password', 'placeholder' => 'Confirm Password', 'class' => 'form-control')) !!}
                        </div>
                    </div>

                    {{-- <div class="form-group row">
                        <label for="roles" class="col-sm-3 col-form-label">Level</label>
                        <div class="col-sm-9">
                            {!! Form::select('roles[]', $roles, $userRole, array('id' => 'roles', 'class' => 'form-control custom-select select2', 'multiple', 'required')) !!}
                        </div>
                    </div> --}}

                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-lg btn-primary">Update</button>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>

@endsection

@section('javascript')
    <script src="{{ asset('modules/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){
            @if ($message = Session::get('success'))
                toastr.success('{{ $message }}', 'Success');
            @endif

            $(".pwstrength").pwstrength();
        });
    </script>
@endsection