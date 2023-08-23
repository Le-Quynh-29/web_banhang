@extends('layouts.app')
@section('style')
    @vite('resources/sass/user.scss')
@endsection
@section('header')
    <div class="container-fluid header-menu">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item"><span>Hệ thống</span></li>
                <li class="breadcrumb-item active"><span><a href="{{route('user.index')}}">Quản lý người dùng</a></span></li>
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
            <div class="form-horizontal">
                <div class="nav-tabs-boxed">
                    <ul class="nav nav-tabs">
                        <li class="nav-item active">
                            <a class="nav-link active">Thông tin người dùng</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active row-cols-lg-auto g-3 align-items-center mb-4 pt-4">
                            <div class="form-group row mb-4">
                                <label class="col-xlg-2 col-sm-2 col-form-label" for="">Tên đăng nhập <em class="required">(*)</em></label>
                                <div class="col-xlg-10 col-sm-10">  
                                    <input class="form-control  @error('username') is-invalid @enderror" name="username" type="text" id="username" placeholder="Nhập tên đăng nhập" value="{!! old('username') !!}">
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-xlg-2 col-sm-2 col-form-label" for="">Họ và tên<em class="required">(*)</em></label>
                                <div class="col-xlg-10 col-sm-10">  
                                    <input class="form-control  @error('fullname') is-invalid @enderror" name="fullname" type="text" id="fullname" placeholder="Nhập họ và tên" value="{!! old('fullname') !!}">
                                    @error('fullname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-xlg-2 col-sm-2 col-form-label" for="">Email <em class="required">(*)</em></label>
                                <div class="col-xlg-10 col-sm-10">  
                                    <input class="form-control  @error('email') is-invalid @enderror" name="email" type="text" id="email" placeholder="Nhập Email" value="{!! old('email') !!}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-xlg-2 col-sm-2 col-form-label" for="">Giới tính <em class="required">(*)</em></label>
                                <div class="col-xlg-10 col-sm-10">  
                                    <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="gender">
                                        <option value="{{\App\Models\User::MALE}}" {{ old('gender') == \App\Models\User::MALE ? 'selected' : '' }}>Nam</option>
                                        <option value="{{\App\Models\User::FEMALE}}" {{ old('gender') == \App\Models\User::FEMALE ? 'selected' : '' }}>Nữ</option>
                                        <option value="{{\App\Models\User::OTHER_GENDER}}" {{ old('gender') == \App\Models\User::OTHER_GENDER ? 'selected' : '' }}>Khác</option>
                                    </select>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-xlg-2 col-sm-2 col-form-label" for="">Ngày sinh <em class="required">(*)</em></label>
                                <div class="col-xlg-10 col-sm-10">  
                                    <input class="form-control  @error('birthday') is-invalid @enderror" name="birthday" type="date" id="birthday" placeholder="Nhập ngày sinh" value="{!! old('birthday') !!}">
                                    @error('birthday')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-xlg-2 col-sm-2 col-form-label" for="">Số điện thoại <em class="required">(*)</em></label>
                                <div class="col-xlg-10 col-sm-10">  
                                    <input class="form-control  @error('phone_number') is-invalid @enderror" name="phone_number" type="text" id="phone_number" placeholder="Nhập số điện thoại" value="{!! old('phone_number') !!}">
                                    @error('phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-xlg-2 col-sm-2 col-form-label" for="">Vai trò <em class="required">(*)</em></label>
                                <div class="col-xlg-10 col-sm-10">  
                                    <select name="role" class="form-control @error('role') is-invalid @enderror" id="role">
                                        <option value="{{\App\Models\User::ROLE_CTV}}" {{ old('role') == \App\Models\User::ROLE_CTV ? 'selected' : '' }}>Cộng tác viên</option>
                                        <option value="{{\App\Models\User::ROLE_ADMIN}}" {{ old('role') == \App\Models\User::ROLE_ADMIN ? 'selected' : '' }}>Quản trị viên</option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-xlg-2 col-sm-2 col-form-label" for="">Trạng thái <em class="required">(*)</em></label>
                                <div class="col-xlg-10 col-sm-10">  
                                    <select name="active" class="form-control @error('active') is-invalid @enderror" id="active">
                                        <option value="{{\App\Models\User::ACTIVE}}" {{ old('active') == \App\Models\User::ACTIVE ? 'selected' : '' }}>Kích hoạt</option>
                                        <option value="{{\App\Models\User::NO_ACTIVE}}" {{ old('active') == \App\Models\User::NO_ACTIVE ? 'selected' : '' }}>Vô hiệu hóa</option>
                                    </select>
                                    @error('active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-xlg-2 col-sm-2 col-form-label" for="">Mật khẩu <em class="required">(*)</em></label>
                                <div class="col-xlg-10 col-sm-10">  
                                    <input class="form-control  @error('password') is-invalid @enderror" name="password" type="password" id="password" placeholder="Nhập mật khẩu" value="{!! old('password') !!}">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-xlg-2 col-sm-2 col-form-label" for="">Ảnh đại diện <em class="required">(*)</em></label>
                                <div class="col-xlg-4 mb-2">  
                                    <label for="image" id="label-avt">
                                        <div id="image-avt" data-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Chọn ảnh để tải lên">File</div>
                                        <input accept="image/*" type='file' class="@error('image') is-invalid @enderror" id="image" name="image"  hidden>
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </label>
                                </div>
                                <div class="col-xlg-6">  
                                    <div id="show-avt">
                                        <img id="blah" alt="">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary" id="submit" type="submit">Thêm mới</button>
                                <a class="btn btn-danger" href="{{route('user.index')}}">Hủy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('javascript')
    <script>
        window.localStorage.setItem('menu-selected', 'user');
    </script>
    @vite('resources/js/users/userCreate.js')
@endsection
