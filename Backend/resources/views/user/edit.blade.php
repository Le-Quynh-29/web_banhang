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
                <li class="breadcrumb-item active"><span>Cập nhật người dùng</span></li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <form action="" method="POST" enctype="multipart/form-data" id="form-edit">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Cập nhật người dùng: <span class="cl-blue">{{ $user->username }}</span></h4>
                <a class="btn btn-primary" href="{{ route('user.show', $user->id) }}">
                    <i class="far fa-circle-info"></i>
                    Chi tiết
                </a>
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
                                       placeholder="Nhập tên đăng nhập" value="{{ $user->username }}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-xlg-4 col-form-label" for="fullname">
                                Họ và tên<em class="required">(*)</em>
                            </label>
                            <div class="col-xlg-8">
                                <input class="form-control" name="fullname" type="text" id="fullname"
                                       placeholder="Nhập họ và tên" value="{{ $user->fullname }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xlg-4 col-form-label" for="image">
                                Ảnh đại diện
                            </label>
                            <div class="col-xlg-8">
                                <div class="image-preview-wrapper">
                                    @if(!is_null($user->image))
                                    <div class="image-preview" style="background-image: url({{ route('content.show', base64_encode('app/' . $user->image)) }});
                                        background-position: center center; background-size: cover">
                                        <label for="image-input" class="image-label hidden">Chọn ảnh</label>
                                        <input type="file" id="image" name="image" class="image-input"
                                               accept="image/*"/>
                                    </div>
                                    @else
                                        <div class="image-preview">
                                            <label for="image-input" class="image-label hidden">Chọn ảnh</label>
                                            <input type="file" id="image" name="image" class="image-input"
                                                   accept="image/*"/>
                                        </div>
                                    @endif
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
                                       placeholder="Nhập email" value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-xlg-4 col-form-label" for="phone_number">
                                Số điện thoại<em class="required">(*)</em>
                            </label>
                            <div class="col-xlg-8">
                                <input class="form-control" name="phone_number" type="text" id="phone_number"
                                       placeholder="Nhập số điện thoại" value="{{ $user->phone_number }}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-xlg-4 col-form-label" for="gender">Giới tính</label>
                            <div class="col-xlg-8">
                                <select name="gender" class="form-control" id="gender">
                                    <option value="{{\App\Models\User::MALE}}"
                                        {{ $user->gender == \App\Models\User::MALE ? 'selected' : '' }}>Nam</option>
                                    <option value="{{\App\Models\User::FEMALE}}"
                                        {{ $user->gender == \App\Models\User::FEMALE ? 'selected' : '' }}>Nữ</option>
                                    <option value="{{\App\Models\User::OTHER_GENDER}}"
                                        {{ $user->gender == \App\Models\User::OTHER_GENDER ? 'selected' : '' }}>Khác</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-xlg-4 col-form-label" for="birthday">Ngày sinh</label>
                            <div class="col-xlg-8">
                                <input class="form-control" name="birthday" type="date" id="birthday" value="{{ $user->birthday }}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-xlg-4 col-form-label" for="role">Vai trò</label>
                            <div class="col-xlg-8">
                                <select name="role" class="form-control" id="role">
                                    <option value="{{\App\Models\User::ROLE_CTV}}"
                                        {{ $user->role == \App\Models\User::ROLE_CTV ? 'selected' : '' }}>
                                        Cộng tác viên
                                    </option>
                                    <option value="{{\App\Models\User::ROLE_ADMIN}}"
                                        {{ $user->role == \App\Models\User::ROLE_ADMIN ? 'selected' : '' }}>
                                        Quản trị viên
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-xlg-4" for="active">Kích hoạt</label>
                            <div class="col-xlg-8">
                                <div class="form-check">
                                    <input class="form-check-input size-20" name="active" type="checkbox" id="active"
                                    {{ $user->active == 1 ? 'checked' : '' }}>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-xlg-4 col-form-label" for="password">
                                Mật khẩu<em class="required">(*)</em>
                            </label>
                            <div class="col-xlg-8">
                                <input class="form-control" name="password" type="password" id="password"
                                       placeholder="Nhập mật khẩu" value="{{ $user->password_raw }}">
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
        _user = {!! $user !!};
        window.localStorage.setItem('menu-selected', 'user');
    </script>
    @vite('resources/js/jquery-validation.js')
    @vite('resources/js/upload-preview.js')
    @vite('resources/js/user/edit.js')
@endsection
