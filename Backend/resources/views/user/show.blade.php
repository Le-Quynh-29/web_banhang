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
                <li class="breadcrumb-item active"><span>Chi tiết người dùng</span></li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h4>Chi tiết người dùng: <span class="cl-blue">{{ $user->username }}</span></h4>
        </div>
        <div class="card-body">
            <div class="row row-cols-lg-auto">
                <div class="col-xlg-4 col-xl-4 col-sm-12">
                    <div class="form-group row">
                        <label class="col-xlg-4 col-form-label font-weight-bold">Ảnh đại diện:</label>
                        <div class="col-xlg-8">
                            <img class="image-user" alt=""
                                 onerror="this.src='{{route('content.show', base64_encode(\App\Models\User::IMAGE_DEFAULT))}}'"
                                 src="{{route('content.show', base64_encode('app/' . $user->image))}}"/>
                        </div>
                    </div>
                </div>
                <div class="col-xlg-4 col-xl-4 col-sm-12">
                    <div class="form-group row">
                        <label class="col-xlg-4 col-form-label font-weight-bold">Tên đăng nhập:</label>
                        <div class="col-xlg-8">
                            <p class="text-break col-form-label">{{$user->username}}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xlg-4 col-form-label font-weight-bold">Họ tên:</label>
                        <div class="col-xlg-8">
                            <p class="text-break col-form-label">{{$user->fullname}}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xlg-4 col-form-label font-weight-bold">Giới tính:</label>
                        <div class="col-xlg-8">
                            <p class="text-break col-form-label">{{$user->convertGender($user->gender)}}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xlg-4 col-form-label font-weight-bold">Ngày sinh:</label>
                        <div class="col-xlg-8">
                            <p class="text-break col-form-label">{{\ShopHelper::formatTime($user->birthday)}}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xlg-4 col-form-label font-weight-bold">Số điện thoại:</label>
                        <div class="col-xlg-8">
                            <p class="text-break col-form-label">{{ \ShopHelper::formatPhoneNumber($user->phone_number)}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-xlg-4 col-xl-4 col-sm-12 mb-2">
                    <div class="form-group row">
                        <label class="col-xlg-4 col-form-label font-weight-bold">Email:</label>
                        <div class="col-xlg-8">
                            <p class="text-break col-form-label">{{$user->email}}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xlg-4 col-form-label font-weight-bold">Trạng thái:</label>
                        <div class="col-xlg-8">
                            <p class="text-break col-form-label">
                                <span class="active">
                                    {!!$user->convertStatus($user->active)!!}
                                </span>
                            </p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xlg-4 col-form-label font-weight-bold">Ngày tạo:</label>
                        <div class="col-xlg-8">
                            <p class="text-break col-form-label">
                                {{\ShopHelper::formatTime($user->created_at)}}
                            </p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xlg-4 col-form-label font-weight-bold">Ngày cập nhật:</label>
                        <div class="col-xlg-8">
                            <p class="text-break col-form-label">
                                {{\ShopHelper::formatTime($user->updated_at)}}
                            </p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xlg-4 col-form-label font-weight-bold">Vai trò:</label>
                        <div class="col-xlg-8">
                            <p class="text-break col-form-label font-weight-bold">
                                {{$user->convertRole($user->role)}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a class="btn btn-primary" href="{{ url()->previous() }}">Quay lại</a>
        </div>
    </div>
@endsection
