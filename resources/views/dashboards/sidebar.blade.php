<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/watermelon.svg')}}" alt="Logo">
                <span class="ml-1 text-primary">Sistem Pakar</span>
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/watermelon.svg')}}" alt="Logo">
            </a>
        </div>
        <ul class="sidebar-menu">
            <li {!! request()->routeIs('dashboard.index') == true ? 'class="active"' : null !!}>
                <a class="nav-link" href="{{ route('dashboard.index') }}"><i class="fas fa-fw fa-fire"></i> <span>Dashboard</span></a>
            </li>

            <li {!! request()->routeIs('dashboard.diseases*') == true ? 'class="active"' : null !!}>
                <a class="nav-link" href="{{ route('dashboard.diseases.index') }}"><i class="fas fa-fw fa-eye-dropper"></i> <span>Data Penyakit</span></a>
            </li>

            <li {!! request()->routeIs('dashboard.symptoms*') == true ? 'class="active"' : null !!}>
                <a class="nav-link" href="{{ route('dashboard.symptoms.index') }}"><i class="fas fa-fw fa-thermometer-half"></i> <span>Data Gejala</span></a>
            </li>
            
            <li class="menu-header">Settings</li>
            <li {!! request()->routeIs('dashboard.users*') == true ? 'class="active"' : null !!}>
                <a href="{{ route('dashboard.users.index') }}" class="nav-link"><i class="far fa-id-badge"></i> <span>Administrator</span></a>
            </li>
        </ul>
    </aside>
</div>