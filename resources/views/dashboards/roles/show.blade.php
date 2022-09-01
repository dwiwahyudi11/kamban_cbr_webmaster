@extends('dashboards.app')

@section('title', 'Detail Role')

@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('dashboard.roles.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>{{ ucwords($role->name) }}</h1>
    <div class="section-header-button ml-auto">
        @can('roles-edit')
            <a class="btn btn-primary" href="{{ route('dashboard.roles.edit', $role->id) }}">Edit</a>
        @endcan
    </div>
</div>

<div class="section-body">

    <div class="row">
        @foreach($permissions as $perms)
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card {{ count($perms->permission) > 0 ? 'card-primary' : '' }}">
                <div class="card-header">
                    <h4>{{ $perms->label }}</h4>
                </div>
                @if(!empty($perms->permission))
                    <ul class="list-group list-group-flush">
                        @foreach($perms->permission as $v)
                            <li class="list-group-item">
                                <i class="ion ion-checkmark-round mr-2"></i>
                                {{ ucwords(str_replace('-', ' ', $v->name)) }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection