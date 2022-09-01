@extends('dashboards.app')

@section('title', 'Create New Role')

@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('dashboard.roles.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Create New Role</h1>
</div>

<div class="section-body">

    {!! Form::open(['method'=>'POST', 'route' => 'dashboard.roles.store', 'autocomplete'=>'off', 'class'=> 'needs-validation', 'novalidate'=> '']) !!}
    <div class="row">
        <div class="col-12">
            
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

                    <div class="form-group row mb-0">
                        <label for="name" class="col-sm-3 col-form-label">Role Name</label>
                        <div class="col-sm-9">
                            {!! Form::text('name', null, array('id' => 'name', 'placeholder' => 'Role Name', 'class' => 'form-control', 'required', 'autofocus')) !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        @foreach($permission as $perms)
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card card-primary">
                <div class="card-header">
                    <h4>{{ $perms->label }}</h4>
                </div>
                @if(!empty($perms->permission))
                    <ul class="list-group list-group-flush">
                        @foreach($perms->permission as $value)
                            <li class="list-group-item">
                                <div class="custom-control custom-checkbox">
                                    {{ Form::checkbox('permission[]', $value->id, false, array('id' => 'role-'. $value->id , 'class' => 'custom-control-input')) }}
                                    <label for="role-{{ $value->id }}" class="custom-control-label">
                                        {{ ucwords(str_replace('-', ' ', $value->name)) }}
                                    </label>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-right">
                    <button type="submit" class="btn btn-lg btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}

</div>

@endsection