@extends('layouts.app')
@section('style')
    @vite('resources/sass/category.scss')
@endsection
@section('header')
    <div class="container-fluid header-menu">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item"><span>Hệ thống</span></li>
                <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Quản lý danh mục</a></li>
                <li class="breadcrumb-item active"><span>Chi tiết danh mục</span></li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h4>Chi tiết danh mục: <span class="cl-blue">{{$category->name}}</span></h4>
        </div>
        <div class="card-body">
            <div class="form-group row mb-4">
                <div class="col-md-5 col-12">
                    <div class="form-group row">
                        <label class="col-xlg-2 col-sm-3 col-form-label font-weight-bold">
                            {{ __('Ảnh') }}
                        </label>
                        <div class="col-xlg-10 col-sm-9">
                            <div class="col-xlg-8">
                                <img class="image-category" alt=""
                                onerror="this.src='{{route('content.show', base64_encode(\App\Models\Category::IMAGE_DEFAULT))}}'"
                                src="{{route('content.show', base64_encode('app/' . $category->image))}}"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-12">
                    <div class="form-group row">
                        <label class="col-xlg-2 col-sm-3 col-form-label font-weight-bold">
                            {{ __('Code') }}
                        </label>
                        <div class="col-xlg-10 col-sm-9">
                            <p class="form-control h-auto text-justify">
                                {{ $category->code }}
                            </p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xlg-2 col-sm-3 col-form-label font-weight-bold">
                            {{ __('Tên') }}
                        </label>
                        <div class="col-xlg-10 col-sm-9">
                            <p class="form-control h-auto text-justify">
                                {{ $category->name }}
                            </p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xlg-2 col-sm-3 col-form-label font-weight-bold">
                            {{ __('Slug') }}
                        </label>
                        <div class="col-xlg-10 col-sm-9">
                            <p class="form-control text-justify h-auto">{{ $category->slug }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xlg-2 col-sm-3 col-form-label font-weight-bold">
                            {{ __('Người thêm') }}
                        </label>
                        <div class="col-xlg-10 col-sm-9">
                            <p class="form-control text-justify h-auto">{{ $category->user->fullname ?? '' }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12">
                    <h6 class="font-weight-bold">
                        {{ __('Các sản phẩm liên quan') }}
                    </h6>
                </div>
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">
                                    <a>ID</a>
                                </th>
                                <th scope="col" class="text-center">
                                    <a>Tên sản phẩm</a>
                                </th>
                                <th scope="col" class="text-center">
                                    <a>Giả</a>
                                </th>
                                <th scope="col" class="text-center">
                                    <a>ảnh</a>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($category->products as $product)
                                <tr id="product-{{$product->id}}">
                                    <td scope="row" class="text-center">
                                        <a class="cl-blue" href="" data-toggle="tooltip"
                                           data-coreui-placement="top" data-coreui-title="Chi tiết">{!!$product->id!!}</a>
                                    </td>
                                    <td class="text-break max-width-250 text-truncate">
                                        <a class="cl-blue" href=""
                                           data-toggle="tooltip" data-coreui-placement="top"
                                           data-coreui-title="Chi tiết">{!!$product->name!!}
                                        </a>
                                    </td>
                                    <td class="text-break">{!!$product->formatPrice($product->price_form).' - '.$product->formatPrice($product->price_to)!!}</td>
                                    <td class="text-center max-width-100">
                                       <img class="image-product"  onerror="this.src='{{route('content.show', base64_encode(\App\Models\Product::IMAGE_DEFAULT))}}'"
                                       src="{{route('content.show', base64_encode('app/' . $product->image))}}" alt="">
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
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('category.index') }}" class="btn btn-primary" type="reset">
                {{ __('Quay lại') }}
            </a>
        </div>
    </div>
@endsection

@section('javascript')
    @parent
    <script>
        window.localStorage.setItem('menu-selected', 'category');
    </script>
@endsection
