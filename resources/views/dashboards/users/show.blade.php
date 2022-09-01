@extends('dashboards.app')

@section('title', 'Detail Administrator')

@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{ route('dashboard.users.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Detail Administrator</h1>
    <div class="section-header-button ml-auto">
        @can('users-edit')
            @if(Auth::user()->id == $user->id || $user->fixed == 0)
            <a class="btn btn-primary" href="{{ route('dashboard.users.edit', $user->id) }}">
                Edit
            </a>
            @endif
        @endcan
    </div>
</div>

<div class="section-body">
    <div class="row mt-sm-4">

        <div class="col-md-2">

            <div class="card card-profile-widget">
                <div class="profile-widget-header p-2">
                    @if($user->avatar)
                        <img src="{{ asset('uploads/avatars/'. $user->avatar) }}" alt="{{ $user->name }}" class="img-fluid rounded-circle profile-widget-picture">
                    @else
                        <img src="{{ asset('images/avatar-1.png') }}" alt="{{ $user->name }}" class="img-fluid rounded-circle profile-widget-picture">
                    @endif
                </div>
            </div>

        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">

                    <ul class="list-unstyled list-unstyled-border mt-4">
                        <li class="media">
                            <div class="media-icon">
                                <i class="ion ion-ios-circle-outline"></i>
                            </div>
                            <div class="media-body">
                                <h6>Full name</h6>
                                <p>{{ $user->name }}</p>
                            </div>
                        </li>

                        <li class="media">
                            <div class="media-icon">
                                <i class="ion ion-ios-circle-outline"></i>
                            </div>
                            <div class="media-body">
                                <h6>Email</h6>
                                <p>{{ $user->email }}</p>
                            </div>
                        </li>

                        {{-- <li class="media">
                            <div class="media-icon">
                                <i class="ion ion-ios-circle-outline"></i>
                            </div>
                            <div class="media-body">
                                <h6>Level</h6>
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $role)
                                        <label class="badge badge-primary">{{ ucwords($role) }}</label>
                                    @endforeach
                                @endif
                            </div>
                        </li> --}}
                    </ul>
                
                </div>
            </div>

        </div>
    </div>
</div>
@endsection