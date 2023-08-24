@extends('layouts.app')
@section('style')
    @vite('resources/sass/category.scss')
@endsection
@section('header')
    <div class="container-fluid header-menu">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item"><span>Hệ thống</span></li>
                <li class="breadcrumb-item active"><span>Quản lý danh mục</span></li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h4> Quản lý danh mục</h4>
            <div class="bgr-cl-blue btn">
                <a href="{{route('category.create')}}" class="cl-while fl-right"> 
                    <i class="fas fa-plus-circle"></i>
                    Thêm mới
                </a>
            </div>
        </div>
        <div class="card-body">
            <form action="" method="GET" id="search-form" class="row row-cols-lg-auto g-3 align-items-center mb-4">
                <div class="col-12">
                    <span class="badge badge-success">Tìm kiếm theo</span>
                </div>
                <div class="col-12">
                    <select class="form-select" name="search_by" id="search_by">
                        <option value="username" <?= request()->search_by == 'username' ? 'selected' : '' ?>>Tên tài khoản</option>
                        <option value="fullname" <?= request()->search_by == 'fullname' ? 'selected' : '' ?>>Tên người dùng</option>
                        <option value="email" <?= request()->search_by == 'email' ? 'selected' : '' ?>>Email</option>
                        <option value="phone_number" <?= request()->search_by == 'phone_number' ? 'selected' : '' ?>>Số điện thoại</option>
                        <option value="role" <?= request()->search_by == 'role' ? 'selected' : '' ?>>Vai trò</option>
                        <option value="active" <?= request()->search_by == 'active' ? 'selected' : '' ?>>Trạng thái</option>
                    </select>
                </div>
                <div class="col-12">
                    <div class="input-group input-option">
                        <input type="text" name="search_text" id="search-text" value="<?= request()->search_text?>" class="form-control <?= (request()->active == null && request()->role == null )  ? 'active' : '' ?>" placeholder="Nhập tìm kiếm...">
                        <select class="form-select <?= (request()->active != null && (request()->role == null && request()->search_text == null)) ? 'active' : '' ?>" id="active" name="active">
                            <option value="{{\App\Models\User::NO_ACTIVE}}" <?= request()->active == \App\Models\User::NO_ACTIVE ? 'selected' : '' ?>>Đã kích hoạt</option>
                            <option value="{{\App\Models\User::ACTIVE}}" <?= request()->active == \App\Models\User::ACTIVE ? 'selected' : '' ?>>Vô hiệu hóa</option>
                        </select>
                        <select class="form-select <?= (request()->role != null && (request()->active == null && request()->search_text == null)) ? 'active' : '' ?>" id="role" name="role">
                            <option value="{{\App\Models\User::ROLE_ADMIN}}" <?= request()->role == \App\Models\User::ROLE_ADMIN ? 'selected' : '' ?>>Quản trị viên</option>
                            <option value="{{\App\Models\User::ROLE_CTV}}" <?= request()->role == \App\Models\User::ROLE_CTV ? 'selected' : '' ?>>Cộng tác viên</option>
                        </select>
                        <span class="input-group-append" id="search" data-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Tìm kiếm">
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
                            <strong id="total-user"> {{$categories->total()}}</strong>
                        </h5>
                    </div>
                </div>
            </div>
            <table class="table table-responsive">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">
                            <a data-field="categories.id" class="laravel-sort">ID</a>
                        </th>
                        <th scope="col" class="text-center">
                            <a data-field="categories.code" class="laravel-sort">Code</a>
                        </th>
                        <th scope="col" class="text-center">
                            <a data-field="categories.name" class="laravel-sort">Tên danh mục</a>
                        </th>
                        <th scope="col" class="text-center">
                            <a data-field="categories.user_id" class="laravel-sort">Người thêm</a>
                        </th>
                        <th scope="col" class="text-center">
                            <a data-field="categories.created_at" class="laravel-sort">Ngày tạo</a>
                        </th>
                        <th scope="col" class="text-center">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($categories))
                        @foreach($categories as $category)
                            <tr id="category-{{$category->id}}">
                                <td scope="row" class="text-center">
                                    <a href="{{route('category.show',$category->id)}}" data-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Chi tiết">{!!$category->id!!}</a>
                                </td>
                                <td class="text-center text-break"><a href="{{route('category.show',$category->id)}}" data-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Chi tiết">{!!$category->code!!}</a></td>
                                <td class="text-center text-break">{!!$category->name!!}</td>
                                <td class="text-center text-break"><a href="{{route('user.show',$category->user->id)}}" data-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Xem người thêm">{!!$category->user->fullname!!}</a></td>
                                <td class="text-center text-break">{!!$category->formatDate($category->updated_at)!!}</td>
                                <td class="">
                                    @if(Auth::user()->role == \App\Models\User::ROLE_ADMIN)
                                        <div class="d-flex jt-cont-sp-bw" >
                                            <a data-toggle="tooltip"  data-coreui-placement="top" data-coreui-title="Cập nhật" href="{{route('category.edit',$category->id)}}">
                                                <i class="p-r fas fa-edit fa-lg"></i>
                                            </a>
                                            <a data-toggle="tooltip" data-id="{{$category->id}}"  data-coreui-placement="top" data-coreui-title="Xóa" class="category-delete" >
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
            <div class="pagination">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@include('modal.confirm')
@endsection
@section('javascript')
    <script>
        var message = {!! json_encode($message) !!};
        var _categoryUrl = {!! json_encode(route('category.index')) !!};
        window.localStorage.setItem('menu-selected', 'category');
    </script>
    @vite('resources/js/category/index.js')
@endsection
