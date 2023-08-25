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
                <li class="breadcrumb-item active">
                    <span><a href="{{route('auth.profile')}}">Thông tin cá nhân</a></span>
                </li>
                <li class="breadcrumb-item active"><span>Cập nhật thông tin cá nhân</span></li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h4>Cập nhật thông tin cá nhân</h4>
        </div>
        <div class="card-body">
            <div class="row row-cols-lg-auto">
                <div class="col-xlg-6 col-xl-6 col-sm-12">
                    <div class="form-group row mb-3">
                        <label class="col-xlg-4 col-form-label font-weight-bold">Tên đăng nhập</label>
                        <div class="col-xlg-8">
                            <p class="text-break col-form-label font-weight-bold cl-blue">{{$user->username}}</p>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-xlg-4 col-form-label font-weight-bold" for="fullname">
                            Họ và tên<em class="required">(*)</em>
                        </label>
                        <div class="col-xlg-8">
                            <input class="form-control" name="fullname" type="text" id="fullname"
                                   placeholder="Nhập họ và tên" value="{{ $user->fullname }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-xlg-4 col-form-label font-weight-bold" for="email">
                            Email<em class="required">(*)</em>
                        </label>
                        <div class="col-xlg-8">
                            <input class="form-control" name="email" type="text" id="email"
                                   placeholder="Nhập email" value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-xlg-4 col-form-label font-weight-bold" for="phone_number">
                            Số điện thoại<em class="required">(*)</em>
                        </label>
                        <div class="col-xlg-8">
                            <input class="form-control" name="phone_number" type="text" id="phone_number"
                                   placeholder="Nhập số điện thoại" value="{{ $user->phone_number }}">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-xlg-4 col-form-label font-weight-bold" for="gender">Giới tính</label>
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
                        <label class="col-xlg-4 col-form-label font-weight-bold" for="birthday">Ngày sinh</label>
                        <div class="col-xlg-8">
                            <input class="form-control" name="birthday" type="date" id="birthday" value="{{ $user->birthday }}">
                        </div>
                    </div>
                </div>
                <div class="col-xlg-6 col-xl-6 col-sm-12">
                    <div class="form-group row">
                        <label class="col-xlg-4 col-form-label font-weight-bold" for="image">
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
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        _user = {!! $user !!};
        window.localStorage.setItem('menu-selected', 'profile');
    </script>
    @vite('resources/js/jquery-validation.js')
    @vite('resources/js/upload-preview.js')
    @vite('resources/js/auth/edit-profile.js')
@endsection
