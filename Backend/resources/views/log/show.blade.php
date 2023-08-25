@extends('layouts.app')

@section('header')
    <div class="container-fluid header-menu">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item"><span>Hệ thống</span></li>
                <li class="breadcrumb-item"><a href="{{ route('log.index') }}">Quản lý log</a></li>
                <li class="breadcrumb-item active"><span>Chi tiết log</span></li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h4>Chi tiết log {{'('.ShopHelper::formatTime($log->created_at).')'}}</h4>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-xlg-2 col-sm-3 col-form-label">
                    {{ __('Tài khoản') }}
                </label>
                <div class="col-xlg-3 col-sm-6">
                    <p class="form-control h-auto text-justify">
                        {{ $log->user?->username }}
                    </p>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xlg-2 col-sm-3 col-form-label">
                    {{ __('Sự kiện') }}
                </label>
                <div class="col-xlg-6 col-sm-6">
                    <p class="form-control h-auto text-justify">
                        {{ $log->event }}
                    </p>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xlg-2 col-sm-3 col-form-label">
                    {{ __('Agent') }}
                </label>
                <div class="col-xlg-10 col-sm-9">
                    <p class="form-control text-justify h-auto">{{ $log->user_agent }}</p>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xlg-2 col-sm-3 col-form-label">
                    {{ __('IP') }}
                </label>
                <div class="col-xlg-3 col-sm-6">
                    <p class="form-control h-auto text-justify">
                        {{ $log->ip_address }}
                    </p>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-xlg-2 col-sm-3 col-form-label">
                    {{ __('Thời gian') }}
                </label>
                <div class="col-xlg-3 col-sm-6">
                    <p class="form-control h-auto text-justify">
                        {{ ShopHelper::covertDateTimeDetail($log->created_at) }}
                    </p>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <h6 class="font-weight-bold">
                        {{ __('Dữ liệu log') }}
                    </h6>
                </div>
                <div class="col-12">
                    <pre id="log-data" class="form-control mb-0 h-auto"></pre>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('log.index') }}" class="btn btn-primary" type="reset">
                {{ __('Quay lại') }}
            </a>
        </div>
    </div>
@endsection

@section('javascript')
    @parent
    <script>
        _log = {!! $log !!};
        window.localStorage.setItem('menu-selected', 'log');
    </script>
    @vite('resources/js/log/show.js')
@endsection
