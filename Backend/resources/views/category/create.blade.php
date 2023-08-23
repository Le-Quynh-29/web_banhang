@extends('layouts.app')
@section('style')
    @vite('resources/sass/category.scss')
@endsection
@section('header')
    <div class="container-fluid header-menu">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item"><span>Hệ thống</span></li>
                <li class="breadcrumb-item active"><span><a href="{{route('category.index')}}">Quản lý danh mục</a></span></li>
                <li class="breadcrumb-item active"><span>Thêm mới danh mục</span></li>
            </ol>
        </nav>
    </div>
@endsection
@section('content')
<form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data" id="form-create">
    @csrf
    <div class="card mb-4">
        <div class="card-header">
            <h4>Thêm mới danh mục</h4>
        </div>
        <div class="card-body">
            <div class="form-horizontal">
                <div class="nav-tabs-boxed">
                    <ul class="nav nav-tabs">
                        <li class="nav-item active">
                            <a class="nav-link active">Thông tin danh mục</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active row-cols-lg-auto g-3 align-items-center mb-4 pt-4">
                            <div class="form-group row mb-4">
                                <label class="col-xlg-2 col-sm-2 col-form-label" for="">Tên danh mục <em class="required">(*)</em></label>
                                <div class="col-xlg-10 col-sm-12">  
                                    <input class="form-control @error('name') is-invalid @enderror" name="name" type="text" id="name" placeholder="Nhập tên danh mục" value="{!! old('name') !!}">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label class="col-xlg-2 col-sm-2 col-form-label" for="">Ảnh danh mục <em class="required">(*)</em></label>
                                <div class="col-xlg-4 mb-2">  
                                    <label for="image" id="label-avt">
                                        <div id="image-avt" data-toggle="tooltip" data-coreui-placement="top" data-coreui-title="Chọn ảnh để tải lên">File</div>
                                        <input accept="image/*" type='file' class="@error('image') is-invalid @enderror" id="image" name="image"  hidden>
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </label>
                                </div>
                                <div class="col-xlg-6">  
                                    <div id="show-avt">
                                        <img id="blah" alt="">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary" id="submit" type="submit">Thêm mới</button>
                                <a class="btn btn-danger" href="{{ url()->previous() }}">Hủy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('javascript')
    <script>
        window.localStorage.setItem('menu-selected', 'category');
    </script>
    @vite('resources/js/category/create.js')
@endsection
