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
            <h4>Chi tiết người dùng <em>(ID: {{$user->id}})</em></h4>
        </div>
        <div class="card-body">
            <div class="row row-cols-lg-auto">
                <div class="col-lg-4 col-xxl-4 mb-2">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            <strong>Tên đăng nhập</strong>
                        </label>
                        <div class="col-md-9">
                            <label class="col-md col-form-label">{{$user->username}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            <strong>Họ tên</strong>
                        </label>
                        <div class="col-md-9">
                            <label class="col-md col-form-label">{{$user->fullname}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            <strong>Giới tính</strong>
                        </label>
                        <div class="col-md-9">
                            <label class="col-md col-form-label">{{$user->convertGender($user->gender)}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            <strong>Ngày sinh</strong>
                        </label>
                        <div class="col-md-9">
                            <label class="col-md col-form-label">{{$user->formatDate($user->birthday)}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            <strong>Số điện thoại</strong>
                        </label>
                        <div class="col-md-9">
                            <label class="col-md col-form-label">{{$user->phone_number}}</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xxl-4 mb-2">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            <strong>Email</strong>
                        </label>
                        <div class="col-md-9">
                            <label class="col-md col-form-label">{{$user->email}}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            <strong>Trạng thái</strong>
                        </label>
                        <div class="col-md-9">
                            <label class="col-md col-form-label">
                                <span class="active">
                                    {!!$user->convertStatus($user->active)!!}
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            <strong>Ngày tạo</strong>
                        </label>
                        <div class="col-md-9">
                            <label class="col-md col-form-label">
                                {{$user->formatDate($user->created_at)}}
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            <strong>Ngày cập nhật</strong>
                        </label>
                        <div class="col-md-9">
                            <label class="col-md col-form-label">
                                {{$user->formatDate($user->updated_at)}}
                            </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            <strong>Vai trò</strong>
                        </label>
                        <div class="col-md-9">
                            <label class="col-md col-form-label">
                                <strong>{{$user->convertRole($user->role)}}</strong>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xxl-4 mb-2">
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">
                            <strong>Ảnh</strong>
                        </label>
                        <div class="col-md-9">
                             <img class="image-user" src="{{asset($user->image)}}" onerror="this.src = '{{ asset('storage/images/user-default.png') }}'" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a class="btn btn-primary" href="{{route('user.index')}}">Trở về</a>
        </div>
    </div>
@endsection