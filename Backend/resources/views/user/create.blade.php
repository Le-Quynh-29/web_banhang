@extends('layouts.app')
@section('style')
    @vite('resources/sass/user.scss')
@endsection
@section('content')
    <form action="{{route('user.store')}}" method="POST" enctype="multipart/form-data" id="form-create">
        @csrf
        <div class="card mb-4">
            <div class="card-header">
                <h4>Thêm mới người dùng</h4>
            </div>
            <div class="card-body">
                <div class="form-horizontal">
                    <div class="nav-tabs-boxed">
                        <ul class="nav nav-tabs">
                            <li class="nav-item active">
                                <a class="nav-link active">Thông tin người dùng</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active row-cols-lg-auto g-3 align-items-center mb-4 pt-4">
                                <div class="form-group row mb-4">
                                    <label class="col-xlg-2 col-sm-2 col-form-label" for="">Tên <em class="required">(*)</em></label>
                                    <div class="col-xlg-10 col-sm-10">
                                        <input class="form-control  @error('name') is-invalid @enderror" name="name" type="text" id="name" placeholder="Nhập tên chiến dịch tấn công mạng" value="{!! old('name') !!}">
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div id="error-name"></div>

                                    </div>
                                </div>
                                <div>
                                    <button class="btn btn-primary" id="submit" type="submit">Thêm mới</button>
                                    <a class="btn btn-danger" href="{{route('user.index')}}">Hủy</a>
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
        var _userUrl = {!! json_encode(route('user.index')) !!};
        window.localStorage.setItem('menu-selected', 'user');
    </script>
    @vite('resources/js/users/userCreate.js')
@endsection
