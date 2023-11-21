    <title>@yield('title', Config::get('osfrportal.name'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/ico" href="{{ asset('osfrportal/images/favicon.ico') }}" />
    <link href="{{ asset('osfrportal/css/sfrfonts.css') }}" rel="stylesheet">
    <link href="{{ asset('osfrportal/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('osfrportal/css/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('osfrportal/css/tabler-icons/tabler-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('osfrportal/css/boxicons/boxicons.css') }}" rel="stylesheet">

    <link href="{{ asset('osfrportal/css/datatables.min.css') }}" rel="stylesheet">

    <link href="{{ asset('osfrportal/css/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('osfrportal/css/select2/select2-bootstrap-5-theme.min.css') }}" rel="stylesheet">

    <link href="{{ asset('osfrportal/css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('osfrportal/css/btn-back-to-top.css') }}" rel="stylesheet">
    <link href="{{ asset('osfrportal/css/other.css') }}" rel="stylesheet">
    <link href="{{ asset('osfrportal/css/multiform.css') }}" rel="stylesheet">
    <link href="{{ asset('osfrportal/css/flasher/flasher-noty.css') }}" rel="stylesheet">
    <link href="{{ asset('osfrportal/css/flasher_noty_bootstrap5_theme.css') }}" rel="stylesheet">



    <meta name="theme-color" content="#712cf9">

    @stack('header-css')
    @stack('header-scripts')
    @livewireStyles

