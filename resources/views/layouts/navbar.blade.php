<div id="main-navbar" class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand sidebar-gone-hide">Sistem Pakar Diagnosa Tanaman Semangka</a>
        <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
        <ul class="navbar-nav navbar-right ml-auto">
            <li class="nav-item active"><a href="{{ route('dashboard.index') }}" class="nav-link">
                @if(Auth::user())
                    <i class="fas fa-fw fa-tachometer-alt"></i> Dashboard</a>
                @else
                    <i class="fas fa-fw fa-sign-in-alt"></i> Login</a>
                @endif
            </li>
        </ul>
    </div>
</nav>

<nav class="navbar navbar-secondary navbar-expand-lg">
    <div class="container">
        <ul class="navbar-nav">
            <li class="nav-item {{ request()->routeIs('home') == true ? 'active' : null }}">
                <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-fw fa-home"></i><span>Home</span></a>
            </li>
            <li class="nav-item dropdown {{ request()->routeIs('diseases') == true ? 'active' : null }}">
                <a href="#" data-toggle="dropdown" class="nav-link has-dropdown"><i class="fas fa-fw fa-eye-dropper"></i><span>Informasi Penyakit</span></a>
                <ul class="dropdown-menu">
                    @foreach($navDiseases as $nav)
                        <li class="nav-item"><a href="{{ route('diseases', $nav->id) }}" class="nav-link">{{ $nav->nama_penyakit }}</a></li>
                    @endforeach
                </ul>
            </li>
            <li class="nav-item {{ request()->routeIs('konsultasi') == true ? 'active' : null }}">
                <a href="{{ route('konsultasi') }}" class="nav-link"><i class="fas fa-fw fa-stethoscope"></i><span>Konsultasi</span></a>
            </li>
        </ul>
    </div>
</nav>