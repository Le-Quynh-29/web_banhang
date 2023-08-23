@extends('layouts.app')

@section('header')
    <div class="container-fluid header-menu">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item"><span>Hệ thống</span></li>
                <li class="breadcrumb-item active"><span>Quản lý log</span></li>
            </ol>
        </nav>
    </div>
@endsection

@section('style')
    @vite('resources/sass/tagify.scss')
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h4>Quản lý log</h4>
        </div>
        <div class="card-body">
            <div class="col-12">
                @include('log.search', ['fields' => [
                            'event' => 'Đối tượng',
                            'user_agent' => 'Agent',
                            'ip_address' => 'IP'
                        ]])
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="float-left">
                        <h5><span class="float-left">Tổng số: </span>&nbsp;
                            <strong> {{$logs->total()}}</strong>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">
                            <a data-field="logs.id" class="laravel-sort">ID</a>
                        </th>
                        <th scope="col" class="text-center">
                            <a data-field="logs.event" class="laravel-sort">Sự kiện</a>
                        </th>
                        <th scope="col" class="text-center">Tài khoản</th>
                        <th scope="col" class="text-center">Agent</th>
                        <th scope="col" class="text-center">IP</th>
                        <th scope="col" class="text-center">
                            <a data-field="logs.created_at" class="laravel-sort">Ngày tạo</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td class="text-center width-50">
                                <a href="{{ route('log.show', $log->id) }}" data-toggle="tooltip"
                                   data-coreui-placement="bottom"
                                   data-coreui-original-title="Chi tiết">{!!$log->id!!}</a>
                            </td>
                            <td class="text-break min-width-100 max-width-400">
                                <a href="{{ route('log.show', $log->id) }}">{!!$log->event!!}</a>
                            </td>
                            <td class="text-center text-break max-width-100">{!!$log->user?->username!!}</td>
                            <td class="text-break max-width-400">{!!$log->user_agent!!}</td>
                            <td class="text-center text-break">{!!$log->ip_address!!}</td>
                            <td class="text-center text-break">{!!$log->formatDate($log->created_at)!!}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Không có dữ liệu</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                {{ $logs->appends(request()->input())->render() }}
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    @parent
    <script>
        _selectedUser = {!! $userTagify !!};
        window.localStorage.setItem('menu-selected', 'log');
    </script>
    @vite('resources/js/tagify.js')
    @vite('resources/js/log/log.js')
@endsection
