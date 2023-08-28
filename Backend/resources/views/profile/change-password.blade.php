@extends('layouts.app')

@section('style')
    @vite('resources/sass/user.scss')
@endsection

@section('header')
    <div class="container-fluid header-menu">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item"><span>Hệ thống</span></li>
                <li class="breadcrumb-item active">
                    <span><a href="{{route('profile.index')}}">Thông tin cá nhân</a></span>
                </li>
                <li class="breadcrumb-item active"><span>Đổi mật khẩu</span></li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <form action="" method="POST" enctype="multipart/form-data" id="form-change-password">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Đổi mật khẩu</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xlg-6 col-xl-6 col-sm-12">
                        <div class="form-group row mb-4">
                            <label class="col-xlg-4 col-form-label" for="password">
                                Mật khẩu hiện tại<em class="required">(*)</em>
                            </label>
                            <div class="col-xlg-8">
                                <input class="form-control" name="password" type="password" id="password"
                                       placeholder="Nhập mật khẩu hiện tại">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-xlg-4 col-form-label" for="new_password">
                                Mật khẩu mới<em class="required">(*)</em>
                            </label>
                            <div class="col-xlg-8">
                                <input class="form-control" name="new_password" type="password" id="new_password"
                                       placeholder="Nhập mật khẩu mới">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xlg-4 col-form-label" for="confirm_password">
                                Nhập lại mật khẩu mới<em class="required">(*)</em>
                            </label>
                            <div class="col-xlg-8">
                                <input class="form-control" name="confirm_password" type="password" id="confirm_password"
                                       placeholder="Nhập lại mật khẩu mới">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" id="submit" type="submit">Cập nhật</button>
                <a class="btn btn-danger" href="{{ url()->previous() }}">Hủy</a>
            </div>
        </div>
    </form>
@endsection

@section('javascript')
    <script>
        window.localStorage.setItem('menu-selected', 'profile');
    </script>
    @vite('resources/js/jquery-validation.js')
    @vite('resources/js/profile/change-password.js')
@endsection
