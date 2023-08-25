@extends('layouts.app')

@section('style')
    @vite('resources/sass/upload-preview.scss')
    @vite('resources/sass/user.scss')
@endsection

@section('header')
    <div class="container-fluid header-menu">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item"><span>Hệ thống</span></li>
                <li class="breadcrumb-item active"><span><a href="{{route('user.index')}}">Quản lý người dùng</a></span>
                </li>
                <li class="breadcrumb-item active"><span>Thêm mới người dùng</span></li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data" id="form-create">
        @csrf
        <div class="card mb-4">
            <div class="card-header">
                <h4>Thêm mới người dùng</h4>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-xlg-6 col-xl-6 col-sm-12">
                        <div class="form-group row mb-4">
                            <label class="col-xlg-4 col-form-label" for="username">
                                Tên đăng nhập<em class="required">(*)</em>
                            </label>
                            <div class="col-xlg-8">
                                <input class="form-control" name="username" type="text" id="username"
                                       placeholder="Nhập tên đăng nhập">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-xlg-4 col-form-label" for="fullname">
                                Họ và tên<em class="required">(*)</em>
                            </label>
                            <div class="col-xlg-8">
                                <input class="form-control" name="fullname" type="text" id="fullname"
                                       placeholder="Nhập họ và tên">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-xlg-4 col-form-label" for="image">
                                Ảnh đại diện
                            </label>
                            <div class="col-xlg-8">
                                <div class="image-preview-wrapper">
                                    <div class="image-preview">
                                        <label for="image-input" class="image-label hidden">Chọn ảnh</label>
                                        <input type="file" id="image" name="image" class="image-input"
                                               accept="image/*"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xlg-6 col-xl-6 col-sm-12">
                        <div class="form-group row mb-4">
                            <label class="col-xlg-4 col-form-label" for="email">
                                Email<em class="required">(*)</em>
                            </label>
                            <div class="col-xlg-8">
                                <input class="form-control" name="email" type="text" id="email"
                                       placeholder="Nhập email">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-xlg-4 col-form-label" for="phone_number">
                                Số điện thoại<em class="required">(*)</em>
                            </label>
                            <div class="col-xlg-8">
                                <input class="form-control" name="phone_number" type="text" id="phone_number"
                                       placeholder="Nhập số điện thoại">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-xlg-4 col-form-label" for="gender">Giới tính</label>
                            <div class="col-xlg-8">
                                <select name="gender" class="form-control" id="gender">
                                    <option value="{{\App\Models\User::MALE}}">Nam</option>
                                    <option value="{{\App\Models\User::FEMALE}}">Nữ</option>
                                    <option value="{{\App\Models\User::OTHER_GENDER}}">Khác</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-xlg-4 col-form-label" for="birthday">Ngày sinh</label>
                            <div class="col-xlg-8">
                                <input class="form-control" name="birthday" type="date" id="birthday">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-xlg-4 col-form-label" for="role">Vai trò</label>
                            <div class="col-xlg-8">
                                <select name="role" class="form-control" id="role">
                                    <option value="{{\App\Models\User::ROLE_CTV}}">Cộng tác viên</option>
                                    <option value="{{\App\Models\User::ROLE_ADMIN}}">Quản trị viên</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-xlg-4" for="active">Kích hoạt</label>
                            <div class="col-xlg-8">
                                <div class="form-check">
                                    <input class="form-check-input size-20" name="active" type="checkbox" id="active">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-xlg-4 col-form-label" for="password">
                                Mật khẩu<em class="required">(*)</em>
                            </label>
                            <div class="col-xlg-8">
                                <input class="form-control" name="password" type="password" id="password"
                                       placeholder="Nhập mật khẩu">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" id="submit" type="submit">Thêm mới</button>
                <a class="btn btn-danger" href="{{ route('user.index') }}">Hủy</a>
            </div>
        </div>
    </form>
@endsection

@section('javascript')
    <script>
        window.localStorage.setItem('menu-selected', 'user');
    </script>
    @vite('resources/js/jquery-validation.js')
    @vite('resources/js/upload-preview.js')
    @vite('resources/js/user/create.js')
@endsection
