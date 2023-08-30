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
            @include('user.search')
            <div class="row mb-3">
                <div class="col-12">
                    <div class="float-left">
                        <h5><span class="float-left">Tổng số: </span>&nbsp;
                            <strong id="total-user"> {{$users->total()}}</strong>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">
                            <a data-field="users.id" class="laravel-sort">ID</a>
                        </th>
                        <th scope="col" class="text-center">
                            <a data-field="users.username" class="laravel-sort">Tên đăng nhập</a>
                        </th>
                        <th scope="col" class="text-center">
                            <a data-field="users.fullname" class="laravel-sort">Họ và Tên</a>
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
                            <td class="text-break">
                                <a class="cl-blue" href="{{route('user.show',$user->id)}}"
                                   data-toggle="tooltip" data-coreui-placement="top"
                                   data-coreui-title="Chi tiết">{!!$user->username!!}
                                </a>
                            </td>
                            <td class="text-break">{!!$user->fullname!!}</td>
                            <td class="text-break max-width-250 text-truncate">{!!$user->email!!}</td>
                            <td class="text-center text-break">{!!$user->phone_number!!}</td>
                            <td class="text-center text-break">{!!$user->convertRole($user->role)!!}</td>
                            <td class="text-center text-break">{!!$user->convertStatus($user->active)!!}</td>
                            <td class="text-center text-break">{!!$user->formatDate($user->updated_at)!!}</td>
                            <td class="width-100">
                                <div class="d-flex justify-content-between
                                    {{$user->id == 1 || auth()->id() == $user->id ? 'width-56' : ''}}">
                                    <a class="cl-blue" data-toggle="tooltip" data-coreui-placement="top"
                                       data-coreui-title="Cập nhật" href="{{route('user.edit',$user->id)}}">
                                        <i class="p-r fas fa-edit fa-lg"></i>
                                    </a>
                                    <form method="POST" action="{{ route('user.unlock.or.lock', $user->id) }}"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="active" value="{{ $user->active == 1 ? 0 : 1 }}">
                                        @if($user->active == 1 && ($user->id != 1 && $user->id != auth()->id()))
                                            <a data-toggle="tooltip" data-coreui-placement="top"
                                               data-coreui-title="Đã kích hoạt" class="modal-lock"
                                               data-active="{{ $user->active }}">
                                                <i class="fas fa-user-unlock fa-lg mr-3 cl-green"></i>
                                            </a>
                                        @elseif($user->active == 0 && ($user->id != 1 && $user->id != auth()->id()))
                                            <a data-toggle="tooltip" data-coreui-placement="top"
                                               data-coreui-title="Vô hiệu hóa" class="modal-lock"
                                               data-active="{{ $user->active }}">
                                                <i class="fas fa-user-lock fa-lg mr-3 cl-red"></i>
                                            </a>
                                        @endif
                                    </form>
                                    @if($user->id !== 1 && auth()->id() !== $user->id)
                                        <form method="POST" action="{{ route('user.destroy', $user->id) }}">
                                            @method('delete')
                                            @csrf
                                            <a data-toggle="tooltip" data-id="{{$user->id}}" data-coreui-placement="top"
                                               data-coreui-title="Xóa" class="modal-confirm" href="javascript:;">
                                                <i class="fas fa-trash fa-lg cl-red"></i>
                                            </a>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">Không có dữ liệu</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                {{ $users->appends(request()->input())->render() }}
            </div>
        </div>
    </div>
    @component('modal.confirm')
        @slot('title')
            Xác nhận xóa người dùng
        @endslot
        @slot('content')
            Bạn có chắc chắn muốn xóa người dùng này không?
        @endslot
        @slot('textBtnSave')
            Có
        @endslot
        @slot('textBtnCancel')
            Không
        @endslot
    @endcomponent
    @component('modal.lock')
        @slot('title')
            Xác nhận vô hiệu hóa người dùng
        @endslot
        @slot('content')
            Bạn có chắc chắn muốn vô hiệu hóa người dùng này không?
        @endslot
        @slot('textBtnSave')
            Vô hiệu hóa
        @endslot
        @slot('textBtnCancel')
            Không
        @endslot
    @endcomponent
@endsection

@section('javascript')
    <script>
        window.localStorage.setItem('menu-selected', 'user');
    </script>
    @vite('resources/js/user/index.js')
@endsection
