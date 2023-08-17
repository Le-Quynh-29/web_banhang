<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link id="favicon" rel="shortcut icon" type="image/png" href="" />
    <title>WEB</title>
    @vite('resources/css/app.css')
    @vite('resources/css/admin.css')
    @vite('resources/css/fontawesome.css')
</head>
<body>
<div class="auth-main">
    <div class="container">
        @yield('content')
    </div>
</div>
@include('backend.layouts.shared.auth-footer')
<script>
    var _appUrl = '{!! url('/') !!}';
    var _token = '{!! csrf_token() !!}';
</script>
@vite('resources/js/app.js')
@yield('javascript')
</body>
</html>
