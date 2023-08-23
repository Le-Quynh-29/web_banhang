@extends('layouts.app')

@section('header')
    <div class="container-fluid header-menu">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item"><span>Hệ thống</span></li>
                <li class="breadcrumb-item active"><span>Vai trò</span></li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h4>Danh sách vai trò</h4>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" class="text-center">
                        <a data-field="roles.id" class="laravel-sort">ID</a>
                    </th>
                    <th scope="col">
                        <a data-field="roles.name" class="laravel-sort">Vai trò</a>
                    </th>
                    <th scope="col" class="text-center"></th>
                </tr>
                </thead>
                <tbody>
                @forelse($roles as $role)
                    <tr>
                        <td class="text-center width-50">{{$role->id}}</td>
                        <td class="text-break min-width-100 max-width-400">{{$role->name}}</td>
                        <td class="text-center text-break width-50">
                            <a class="cl-blue" href="{{route('permission.edit', $role->id)}}"
                               data-toggle="tooltip" data-placement="bottom"
                               data-original-title="Chỉnh sửa phân quyền">
                                <i class="far fa-list fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Không có dữ liệu</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            <div class="pagination">
                {{ $roles->appends(request()->input())->render() }}
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    @parent
    <script>
        window.localStorage.setItem('menu-selected', 'permission');
    </script>
@endsection
