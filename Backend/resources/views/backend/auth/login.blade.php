@extends('backend.layouts.auth')

@section('content')
    <h2 class="inner-tittle page">
        <i class="fa-solid fa-crown"></i>
        Queen
        <i class="fa-solid fa-crown"></i>
    </h2>
    <div class="auth">
        <h3 class="inner-tittle t-inner">Đăng nhập</h3>
        <form action="{{ route('admin.login') }}" method="POST" id="form-admin-login">
            @csrf
            <div class="form-group text-left">
                <input type="text" placeholder="E-mail" name="email" id="email" autocomplete="off"/>
            </div>
            <div class="form-group text-left">
                <input type="password" placeholder="Password" name="password" id="password"/>
            </div>
            <div class="new">
                <p><label class="checkbox"><input type="checkbox" name="remember"><i> </i>Lưu đăng nhập</label></p>
            </div>
            <div class="submit">
                <input type="submit" value="Đăng nhập">
            </div>
        </form>
        <a>Quên mật khẩu?</a>
    </div>
@endsection

@section('javascript')
    @vite('resources/js/jquery-validation.js')
    @vite('resources/js/admin-login.js')
@endsection
