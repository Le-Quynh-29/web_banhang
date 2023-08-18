<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link id="favicon" type="image/png" href="" />
    <title>QUEEN SHOP</title>
    @vite('resources/sass/app.scss')
</head>
<body class="c-style-app">
<div class="c-body">
    <main class="auth">
        @yield('content')
    </main>
    @include('layouts.shared.footer')
</div>
<script>
    var _appUrl = '{!! url('/') !!}';
    var _token = '{!! csrf_token() !!}';
</script>
@vite('resources/js/app.js')
@yield('javascript')
</body>
</html>
