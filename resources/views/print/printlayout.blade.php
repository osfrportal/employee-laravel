<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('osfrportal::layout.header')
</head>

<body>
    @yield('content', '')
</body>
@include('osfrportal::layout.footer')
</html>
