<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') &mdash; {{ config('app.name') }}</title>

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="{{ asset('modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('modules/fontawesome/css/all.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @yield('styles')
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">

</head>
<body id="silhouette-bg">
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            @include('dashboards.navbar')
            @include('dashboards.sidebar')

            <div class="main-content">
                <section class="section">
                    @yield('content')
                </section>
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; {{ date('Y') }} <div class="bullet"></div> <span class="text-muted">{{ config('app.name') }}</span>
                </div>
            </footer>

        </div>
    </div>

    @stack('modals')

    <script src="{{ asset('modules/jquery.min.js' ) }}"></script>
    <script src="{{ asset('modules/popper.js' ) }}"></script>
    <script src="{{ asset('modules/tooltip.js' ) }}"></script>
    <script src="{{ asset('modules/bootstrap/js/bootstrap.min.js' ) }}"></script>
    <script src="{{ asset('modules/nicescroll/jquery.nicescroll.min.js' ) }}"></script>
    <script src="{{ asset('modules/moment.min.js' ) }}"></script>
    <script src="{{ asset('modules/toastr.min.js' ) }}"></script>
    <script src="{{ asset('js/stisla.js' ) }}"></script>
    <script src="{{ asset('js/scripts.js') }}"></script>

    @yield('javascript')
</body>
</html>
