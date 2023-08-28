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
            <a href="{{route('category.create')}}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                Thêm mới
            </a>
        </div>
        <div class="card-body">
            @include('category.search')
            <div class="row mb-3">
                <div class="col-12">
                    <div class="float-left">
                        <h5><span class="float-left">Tổng số: </span>&nbsp;
                            <strong id="total-category"> {{$categories->total()}}</strong>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">
                            <a data-field="categories.id" class="laravel-sort">ID</a>
                        </th>
                        <th scope="col" class="text-center">
                            <a data-field="categories.code" class="laravel-sort">Mã code</a>
                        </th>
                        <th scope="col" class="text-center">
                            <a data-field="categories.name" class="laravel-sort">Tên danh mục</a>
                        </th>
                        <th scope="col" class="text-center">
                            <a>Sản phẩm liên quan</a>
                        </th>
                        <th scope="col" class="text-center">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($categories as $category)
                        <tr id="category-{{$category->id}}">
                            <td scope="row" class="text-center">
                                <a class="cl-blue" href="{{route('category.show',$category->id)}}" data-toggle="tooltip"
                                   data-coreui-placement="top" data-coreui-title="Chi tiết">{!!$category->id!!}</a>
                            </td>
                            <td class="text-break">
                                <a class="cl-blue" href="{{route('category.show',$category->id)}}"
                                   data-toggle="tooltip" data-coreui-placement="top"
                                   data-coreui-title="Chi tiết">{!!$category->code!!}
                                </a>
                            </td>
                            <td class="text-break max-width-250 text-truncate">{!!$category->name!!}</td>
                            <td class="text-break">
                                <ul class="product-list">
                                    @forelse($category->products->take(3) as $product)
                                        <li>{{$product->name}}</li>
                                    @empty
                                        <li>Không có sản phẩm</li>
                                    @endforelse
                                    @if ($category->products->count() > 3)
                                        <li>...</li>
                                    @endif
                                </ul>
                            </td>
                            <td class="width-70">
                                <div class="d-flex justify-content-between">
                                    @can('pmss--category-update')
                                    <a class="cl-blue" data-toggle="tooltip" data-coreui-placement="top"
                                       data-coreui-title="Cập nhật" href="{{route('category.edit',$category->id)}}">
                                        <i class="p-r fas fa-edit fa-lg"></i>
                                    </a>
                                    @endcan
                                    @can('pmss--category-delete')
                                        <form method="POST" action="{{ route('category.destroy', $category->id) }}">
                                            @method('delete')
                                            @csrf
                                            <a data-toggle="tooltip" data-id="{{$category->id}}" data-coreui-placement="top"
                                               data-coreui-title="Xóa" class="modal-confirm" href="javascript:;">
                                                <i class="fas fa-trash fa-lg cl-red"></i>
                                            </a>
                                        </form>
                                    @endcan
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
                {{ $categories->appends(request()->input())->render() }}
            </div>
        </div>
    </div>
    @component('modal.confirm')
        @slot('title')
            Xác nhận xóa danh mục
        @endslot
        @slot('content')
            Bạn có chắc chắn muốn xóa danh mục này không?
        @endslot
        @slot('textBtnSave')
            Có
        @endslot
        @slot('textBtnCancel')
            Không
        @endslot
    @endcomponent
@endsection
@section('javascript')
    <script>
        window.localStorage.setItem('menu-selected', 'category');
    </script>
@endsection
