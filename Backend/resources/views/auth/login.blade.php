@extends('layouts.auth')

@section('content')
    <div class="login">
        <h2 class="title">
            <i class="fas fa-crown"></i>
            queen shop
            <i class="fas fa-crown"></i>
        </h2>
        <div class="container c-auth mtb-auto">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mx-4">
                        <div class="card-body p-4">
                            <form method="post" action="{{ route('admin.login') }}" id="form-login">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="lbt-login">Đăng nhập</h1>
                                    </div>
                                </div>
                                <div class="form-group mt-3 mb-3 pl-5 pr-5">
                                    <label class="form-label font-weight-bold" for="email">Email</label>
                                    <input id="email" class="form-control" type="text" placeholder="Email"
                                           name="email"  value="" autofocus>
                                </div>
                                <div class="form-group mb-3 pl-5 pr-5">
                                    <label class="form-label font-weight-bold" for="password">Mật khẩu</label>
                                    <input id="password" class="form-control" type="password" placeholder="Mật khẩu"
                                           name="password" autocomplete>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="remember" type="checkbox" id="remember">
                                    <label class="form-check-label" for="remember">Lưu đăng nhập</label>
                                </div>
                                <div class="ml-auto pt-4 pl-5 pr-5 float-right ">
                                    <button class="btn btn-primary btn-auth" type="submit" id="submit-form-login">Đăng nhập</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        window.localStorage.removeItem('menu-selected');
    </script>
    @vite('resources/js/jquery-validation.js')
    @vite('resources/js/auth/login.js')
@endsection
