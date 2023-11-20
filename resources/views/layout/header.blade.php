    <title>@yield('title', Config::get('osfrportal.name'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/ico" href="{{ asset('osfrportal/images/favicon.ico') }}" />
    <link href="{{ asset('osfrportal/css/sfrfonts.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css"
        crossorigin="anonymous">

    <link href="{{ asset('osfrportal/css/tabler-icons/tabler-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('osfrportal/css/boxicons/boxicons.css') }}" rel="stylesheet">
    <link
        href="https://cdn.datatables.net/v/bs5/jszip-2.5.0/dt-1.13.4/b-2.3.6/b-html5-2.3.6/b-print-2.3.6/date-1.4.1/fc-4.2.2/fh-3.3.2/r-2.4.1/rg-1.3.1/sc-2.1.1/sl-1.6.2/sr-1.2.2/datatables.min.css"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="{{ asset('osfrportal/css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('osfrportal/css/btn-back-to-top.css') }}" rel="stylesheet">
    <link href="{{ asset('osfrportal/css/other.css') }}" rel="stylesheet">
    <link href="{{ asset('osfrportal/css/multiform.css') }}" rel="stylesheet">
    <link href="{{ asset('osfrportal/css/flasher_noty_bootstrap5_theme.css') }}" rel="stylesheet">



    <meta name="theme-color" content="#712cf9">

    @stack('header-css')
    @stack('header-scripts')
    @livewireStyles
