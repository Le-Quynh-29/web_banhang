@extends('layouts.app')

@section('content')

    <div class="card mb-4">
        <div class="card-header">
            <h4> Quản lý người dùng</h4>
                <a href="{{route('user.create')}}" class="cl-blue fl-right">
                    <i class="fas fa-plus-circle"></i>
                    Thêm mới
                </a>
        </div>
        <div class="card-body">
            <form action="" method="GET" class="row row-cols-lg-auto g-3 align-items-center mb-4">
                <div class="col-12">
                    <span class="badge badge-success">Tìm kiếm theo</span>
                </div>
                <div class="col-12">
                    <select class="form-select" name="status">
                      <option selected value="">-- Trạng thái tài khoản --</option>
                      <option value="0" <?= request()->status == '0' ? 'selected' : '' ?>>Đang hoạt động</option>
                      <option value="1" <?= request()->status == '1' ? 'selected' : '' ?>>Vô hiệu hóa</option>
                    </select>
                </div>
                <div class="col-12">
                    <select class="form-select" name="role">
                      <option selected value="" >-- Cấp bậc --</option>
                      <option value="1" <?= request()->role == '1' ? 'selected' : '' ?>>Quản trị viên</option>
                      <option value="2" <?= request()->role == '2' ? 'selected' : '' ?>>Người dùng</option>
                    </select>
                </div>
                <div class="col-12">
                    <select class="form-select" name="search_by">
                      <option selected value="" >-- Tìm kiếm theo --</option>
                      <option value="username" <?= request()->search_by == 'username' ? 'selected' : '' ?>>Tên đăng nhập</option>
                      <option value="fullname" <?= request()->search_by == 'fullname' ? 'selected' : '' ?>>Họ và tên</option>
                      <option value="email" <?= request()->search_by == 'email' ? 'selected' : '' ?>>Email</option>
                      <option value="phone_number" <?= request()->search_by == 'phone_number' ? 'selected' : '' ?>>Số điện thoại</option>
                    </select>
                </div>
                <div class="col-12">
                    <div class="input-group">
                        <input type="text" name="search_text" value="<?= request()->search_text?>" class="form-control" placeholder="Nhập tìm kiếm...">
                        <span class="input-group-append">
                            <button class="btn btn-primary">
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
                            <strong> {{$users->total()}}</strong>
                        </h5>
                    </div>
                </div>
                </div>
              <table class="table table-responsive-sm">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">
                            <a data-field="users.id" class="laravel-sort">ID</a>
                        </th>
                        <th scope="col" class="text-center">
                            <a data-field="users.username" class="laravel-sort">Họ và Tên</a>
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
                    @if(isset($users))
                    @foreach($users as $user)
                    <tr>
                        <th scope="row" class="text-center width-50">
                            <a href="{{route('user.show',$user->id)}}" data-toggle="tooltip" data-coreui-placement="bottom" data-coreui-original-title="Chi tiết">{!!$user->id!!}</a>
                        </th>
                        <td class="text-center text-break"><a href="{{route('user.show',$user->id)}}">{!!$user->fullname!!}</a></td>
                        <td class="text-center text-break">{!!$user->email!!}</td>
                        <td class="text-center text-break">{!!$user->phone_number!!}</td>
                        <td class="text-center text-break">{!!$user->convertRole($user->role)!!}</td>
                        <td class="text-center text-break">{!!$user->convertStatus($user->active)!!}</td>
                        <td class="text-center text-break">{!!$user->formatDate($user->updated_at)!!}</td>
                        <td class="width-80">
                            @if($user->role == \App\Models\User::ROLE_ADMIN)
                            <div class="d-flex jt-cont-sp-bw" >
                                <a data-toggle="tooltip" data-coreui-placement="bottom" data-coreui-original-title="Cập nhật" href="{{route('user.edit',$user->id)}}">
                                    <i class="p-r fas fa-edit fa-lg"></i>
                                </a>
                                <a data-toggle="tooltip" data-coreui-placement="bottom" data-coreui-original-title="Xóa">
                                    <i class="fas fa-trash fa-lg cl-red"></i>
                                </a>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td  colspan="8">Không có dữ liệu</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection