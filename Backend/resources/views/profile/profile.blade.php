@extends('layouts.app')

@section('style')
    @vite('resources/sass/user.scss')
@endsection

@section('header')
    <div class="container-fluid header-menu">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item"><span>Hệ thống</span></li>
                <li class="breadcrumb-item active"><span>Thông tin cá nhân</span></li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h4>Thông tin cá nhân</h4>
            <a class="btn btn-primary" href="{{ route('profile.edit') }}">
                <i class="far fa-user-edit"></i>
                Sửa
            </a>
        </div>
        <div class="card-body">
            <div class="row row-cols-lg-auto">
                <div class="col-xlg-6 col-xl-6 col-sm-12">
                    <div class="form-group row">
                        <label class="col-xlg-4 col-form-label font-weight-bold">Ảnh đại diện:</label>
                        <div class="col-xlg-5">
                            <img class="image-user" alt=""
                                 onerror="this.src='{{route('content.show', base64_encode(\App\Models\User::IMAGE_DEFAULT))}}'"
                                 src="{{route('content.show', base64_encode('app/' . $user->image))}}"/>
                        </div>
                    </div>
                </div>
                <div class="col-xlg-6 col-xl-6 col-sm-12">
                    <div class="form-group row">
                        <label class="col-xlg-4 col-form-label font-weight-bold">Tên đăng nhập</label>
                        <div class="col-xlg-8">
                            <p class="text-break col-form-label">{{$user->username}}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xlg-4 col-form-label font-weight-bold">Họ và tên</label>
                        <div class="col-xlg-8">
                            <p class="text-break col-form-label">{{$user->fullname}}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xlg-4 col-form-label font-weight-bold">Giới tính</label>
                        <div class="col-xlg-8">
                            <p class="text-break col-form-label">{{ $user->convertGender($user->gender) }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xlg-4 col-form-label font-weight-bold">Ngày sinh</label>
                        <div class="col-xlg-8">
                            <p class="text-break col-form-label">{{ \ShopHelper::formatTime($user->birthday) }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xlg-4 col-form-label font-weight-bold">Email</label>
                        <div class="col-xlg-8">
                            <p class="text-break col-form-label">{{$user->email}}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xlg-4 col-form-label font-weight-bold">Số điện thoại</label>
                        <div class="col-xlg-8">
                            <p class="text-break col-form-label">{{ \ShopHelper::formatPhoneNumber($user->phone_number) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        window.localStorage.setItem('menu-selected', 'profile');
    </script>
@endsection
