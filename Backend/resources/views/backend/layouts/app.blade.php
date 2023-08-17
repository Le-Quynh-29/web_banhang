<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link id="favicon" rel="shortcut icon" type="image/png" href=""/>
    <title>WEB</title>
    @vite('resources/css/app.css')
    @vite('resources/css/admin.css')
    @vite('resources/css/fontawesome.css')
    @yield('style')
</head>
<body>
<div class="page-container">
    <div class="left-content">
        <div class="inner-content">
            @include('backend.layouts.shared.header')
            <div class="outter-wp">
                @yield('content')
            </div>
            @include('backend.layouts.shared.footer')
        </div>
    </div>
    @include('backend.layouts.shared.navbar')
</div>
<script>
    var _appUrl = '{!! url('/') !!}';
    var _token = '{!! csrf_token() !!}';
</script>
@vite('resources/js/app.js')
@vite('resources/js/header.js')
@yield('javascript')
</body>
</html>
