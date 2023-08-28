@extends('layouts.app')

@section('style')
    @vite('resources/sass/upload-preview.scss')
    @vite('resources/sass/category.scss')
@endsection

@section('header')
    <div class="container-fluid header-menu">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item"><span>Hệ thống</span></li>
                <li class="breadcrumb-item active">
                    <span><a href="{{route('category.index')}}">Quản lý danh mục</a></span>
                </li>
                <li class="breadcrumb-item active"><span>Cập nhật danh mục</span></li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <form action="" method="POST" enctype="multipart/form-data" id="form-edit">
        <div class="card mb-4">
            <div class="card-header">
                <h4>Cập nhật danh mục: <span class="cl-blue">{{ $category->name }}</span></h4>
                <a class="btn btn-primary" href="{{ route('category.show', $category->id) }}">
                    <i class="far fa-circle-info"></i>
                    Chi tiết
                </a>
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <div class="col-xlg-6 col-xl-6 col-sm-12">
                        <div class="form-group row mb-4">
                            <label class="col-xlg-4 col-form-label" for="name">
                                Tên danh mục<em class="required">(*)</em>
                            </label>
                            <div class="col-xlg-8">
                                <input class="form-control" name="name" type="text" id="name"
                                       placeholder="Nhập tên danh mục" value="{{ $category->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xlg-4 col-form-label" for="image">
                                Ảnh danh mục
                            </label>
                            <div class="col-xlg-8">
                                <div class="image-preview-wrapper">
                                    @if(!is_null($category->image))
                                    <div class="image-preview" style="background-image: url({{ route('content.show', base64_encode('app/' . $category->image)) }});
                                        background-position: center center; background-size: cover">
                                        <label for="image-input" class="image-label hidden">Chọn ảnh</label>
                                        <input type="file" id="image" name="image" class="image-input"
                                               accept="image/*"/>
                                    </div>
                                    @else
                                        <div class="image-preview">
                                            <label for="image-input" class="image-label hidden">Chọn ảnh</label>
                                            <input type="file" id="image" name="image" class="image-input"
                                                   accept="image/*"/>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" id="submit" type="submit">Cập nhật</button>
                <a class="btn btn-danger" href="{{ url()->previous() }}">Hủy</a>
            </div>
        </div>
    </form>
@endsection

@section('javascript')
    <script>
        _category = {!! $category !!};
        window.localStorage.setItem('menu-selected', 'category');
    </script>
    @vite('resources/js/jquery-validation.js')
    @vite('resources/js/upload-preview.js')
    @vite('resources/js/category/edit.js')
@endsection
