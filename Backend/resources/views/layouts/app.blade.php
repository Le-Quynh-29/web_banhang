<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link id="favicon" rel="shortcut icon" type="image/png" href=""/>
    <title>QUEEN SHOP</title>
    @vite('resources/sass/app.scss')
    @yield('style')
</head>
<body class="c-style-app">
<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    @include('layouts.shared.navbar')
</div>
<div class="wrapper d-flex flex-column min-vh-100 bg-light">
    @include('layouts.shared.header')
    <div class="body flex-grow-1 px-3">
        <div class="container-lg">
            @yield('content')
        </div>
    </div>
    @include('layouts.shared.footer')
</div>

<script>
    var _appUrl = '{!! url('/') !!}';
    var _token = '{!! csrf_token() !!}';
</script>
@vite('resources/js/app.js')
@vite('resources/js/tooltips.js')
@vite('resources/js/navbar.js')
@yield('javascript')
</body>
</html>
