@extends('layouts.app')
@section('style')
    @vite('resources/sass/user.scss')
@endsection
@section('header')
    <div class="container-fluid header-menu">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item"><span>Hệ thống</span></li>
                <li class="breadcrumb-item active"><span>Quản lý người dùng</span></li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h4> Quản lý người dùng</h4>
            <a href="{{route('user.create')}}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                Thêm mới
            </a>
        </div>
        <div class="card-body">
            <form action="" method="GET" id="search-form" class="row row-cols-lg-auto g-3 align-items-center mb-4">
                <div class="col-12">
                    <span class="badge badge-success">Tìm kiếm theo</span>
                </div>
                <div class="col-12">
                    <select class="form-select" name="search_by" id="search_by">
                        <option value="username" <?= request()->search_by == 'username' ? 'selected' : '' ?>>Tên đăng nhập</option>
                        <option value="fullname" <?= request()->search_by == 'fullname' ? 'selected' : '' ?>>Tên người dùng</option>
                        <option value="email" <?= request()->search_by == 'email' ? 'selected' : '' ?>>Email</option>
                        <option value="phone_number" <?= request()->search_by == 'phone_number' ? 'selected' : '' ?>>Số điện thoại</option>
                        <option value="role" <?= request()->search_by == 'role' ? 'selected' : '' ?>>Vai trò</option>
                        <option value="active" <?= request()->search_by == 'active' ? 'selected' : '' ?>>Trạng thái </option>
                    </select>
                </div>
                <div class="col-12">
                    <div class="input-group input-option">
                        <input type="text" name="search_text" id="search-text" value="<?= request()->search_text?>"
                               class="form-control <?= (request()->active == null && request()->role == null) ? 'active' : '' ?>"
                               placeholder="Nhập tìm kiếm...">
                        <select
                            class="form-select <?= (request()->active != null && (request()->role == null && request()->search_text == null)) ? 'active' : '' ?>"
                            id="active" name="active">
                            <option
                                value="{{\App\Models\User::NO_ACTIVE}}" <?= request()->active == \App\Models\User::NO_ACTIVE ? 'selected' : '' ?>>
                                Đã kích hoạt
                            </option>
                            <option
                                value="{{\App\Models\User::ACTIVE}}" <?= request()->active == \App\Models\User::ACTIVE ? 'selected' : '' ?>>
                                Vô hiệu hóa
                            </option>
                        </select>
                        <select
                            class="form-select <?= (request()->role != null && (request()->active == null && request()->search_text == null)) ? 'active' : '' ?>"
                            id="role" name="role">
                            <option
                                value="{{\App\Models\User::ROLE_ADMIN}}" <?= request()->role == \App\Models\User::ROLE_ADMIN ? 'selected' : '' ?>>
                                Quản trị viên
                            </option>
                            <option
                                value="{{\App\Models\User::ROLE_CTV}}" <?= request()->role == \App\Models\User::ROLE_CTV ? 'selected' : '' ?>>
                                Cộng tác viên
                            </option>
                        </select>
                        <span class="input-group-append" id="search" data-toggle="tooltip" data-coreui-placement="top"
                              data-coreui-title="Tìm kiếm">
                            <button class="btn btn-search">
                                <i class="fas fa-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </form>
            <div class="row mb-3">
                <div class="col-12">
                    <div class="float-left">
                        <h5><span class="float-left">Tổng số: </span>&nbsp;
                            <strong id="total-user"> {{$users->total()}}</strong>
                        </h5>
                    </div>
                </div>
            </div>
            <table class="table table-responsive">
                <thead>
                <tr>
                    <th scope="col" class="text-center">
                        <a data-field="users.id" class="laravel-sort">ID</a>
                    </th>
                    <th scope="col" class="text-center">
                        <a data-field="users.fullname" class="laravel-sort">Họ và Tên</a>
                    </th>
                    <th scope="col" class="text-center">
                        <a data-field="users.username" class="laravel-sort">Tên đăng nhập</a>
                    </th>
                    <th scope="col" class="text-center">
                        <a data-field="users.email" class="laravel-sort">Email</a>
                    </th>
                    <th scope="col" class="text-center">
                        <a data-field="users.phone_number" class="laravel-sort">Số điện thoại</a>
                    </th>
                    <th scope="col" class="text-center">
                        <a data-field="users.role" class="laravel-sort">Chức vụ</a>
                    </th>
                    <th scope="col" class="text-center">
                        <a data-field="users.active" class="laravel-sort">Trạng thái</a>
                    </th>
                    <th scope="col" class="text-center">
                        <a data-field="users.created_at" class="laravel-sort">Ngày tạo</a>
                    </th>
                    <th scope="col" class="text-center">
                    </th>
                </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr id="user-{{$user->id}}">
                            <td scope="row" class="text-center">
                                <a class="cl-blue" href="{{route('user.show',$user->id)}}" data-toggle="tooltip"
                                   data-coreui-placement="top" data-coreui-title="Chi tiết">{!!$user->id!!}</a>
                            </td>
                            <td class="text-center text-break">
                                <a class="cl-blue" href="{{route('user.show',$user->id)}}"
                                   data-toggle="tooltip" data-coreui-placement="top"
                                   data-coreui-title="Chi tiết">{!!$user->fullname!!}
                                </a>
                            </td>
                            <td class="text-center text-break">{!!$user->username!!}</td>
                            <td class="text-center text-break">{!!$user->email!!}</td>
                            <td class="text-center text-break">{!!$user->phone_number!!}</td>
                            <td class="text-center text-break">{!!$user->convertRole($user->role)!!}</td>
                            <td class="text-center text-break">{!!$user->convertStatus($user->active)!!}</td>
                            <td class="text-center text-break">{!!$user->formatDate($user->updated_at)!!}</td>
                            <td class="">
                                @if(Auth::user()->role == \App\Models\User::ROLE_ADMIN)
                                    <div class="d-flex jt-cont-sp-bw">
                                        <a class="cl-blue" data-toggle="tooltip" data-coreui-placement="top"
                                           data-coreui-title="Cập nhật" href="{{route('user.edit',$user->id)}}">
                                            <i class="p-r fas fa-edit fa-lg"></i>
                                        </a>
                                        @if($user->active == 1)
                                            <a data-toggle="tooltip" data-id="{{$user->id}}" data-coreui-placement="top"
                                               data-coreui-title="Đã kích hoạt" class="user-unlock">
                                                <i class="icon-lock fas fa-user-unlock fa-lg mr-3 cl-green"></i>
                                            </a>
                                        @elseif($user->active == 0)
                                            <a data-toggle="tooltip" data-id="{{$user->id}}" data-coreui-placement="top"
                                               data-coreui-title="Vô hiệu hóa" class="user-lock">
                                                <i class="icon-user-lock fas fa-user-lock fa-lg mr-3 cl-red"></i>
                                            </a>
                                        @endif
                                        @if(\App\Models\User::ROLE_ADMIN != $user->role)
                                            <a data-toggle="tooltip" data-id="{{$user->id}}" data-coreui-placement="top"
                                               data-coreui-title="Xóa" class="user-delete">
                                                <i class="fas fa-trash fa-lg cl-red"></i>
                                            </a>
                                        @endif
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="8">Không có dữ liệu</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="pagination">
                {{ $users->links() }}
            </div>
        </div>
    </div>
    @include('modal.confirm')
@endsection
@section('javascript')
    <script>
        var message = {!! json_encode($message) !!};
        var _userUrl = {!! json_encode(route('user.index')) !!};
        var _userDeleteUrl = {!! json_encode(route('user.destroy','id')) !!};
        var _userUnlockOrLockUrl = {!! json_encode(route('ajax.user.unlock.or.lock')) !!};
        window.localStorage.setItem('menu-selected', 'user');
    </script>
    @vite('resources/js/user/index.js')
@endsection
