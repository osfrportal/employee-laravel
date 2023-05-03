    <title>@yield('title', Config::get('osfrportal.name'))</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/ico" href="{{ asset('osfrportal/images/favicon.ico') }}" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
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

    <meta name="theme-color" content="#712cf9">

    @stack('header-css')
    @stack('header-scripts')
