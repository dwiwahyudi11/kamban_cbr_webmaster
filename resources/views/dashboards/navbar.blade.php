<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <div class="">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </div>
    {{-- <div class="navbar-brand mb-0 d-none d-md-block">
        <h1 class="double-rounded active">{{ config('app.name') }}</h1>
    </div>
    <div class="navbar-brand mb-0 mr-0 d-md-none">
        <h1 class="double-rounded active">Simple</h1>
    </div> --}}
    <ul class="navbar-nav navbar-right ml-auto">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                @if($avatar = Auth::user()->avatar)
                    <img alt="image" src="{{ asset('uploads/avatars/'. $avatar )}}" width="30" class="rounded-circle mr-1">
                @else
                    <i class="fas fa-fw fa-user-circle"></i>
                @endif
                <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
    
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Logged in {{ Carbon\Carbon::parse(Auth::user()->last_login_at)->diffForHumans() }}</div>
                <a href="{{ route('dashboard.profile') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" class="d-none" action="{{ route('logout') }}" method="POST">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>