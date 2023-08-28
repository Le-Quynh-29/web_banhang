@extends('layouts.app')

@section('header')
    <div class="container-fluid header-menu">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item"><span>Hệ thống</span></li>
                <li class="breadcrumb-item"><a href="{{ route('permission.index') }}">Phân quyền</a></li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <form action="{{ route('permission.update', $role->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card mb-4">
            <div class="card-header">
                <h4>Phân quyền vai trò: <span class="cl-blue">{{ $role->name }}</span></h4>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($permissions as $name => $groups)
                        <div class="col-xlg-4 col-xl-4 col-sm-12 per-margin">
                            <h5>{{$name}}</h5>
                            @foreach($groups as $permission)
                                <div class="form-check {{ $role->checkDisablePermission($permission->id) }}">
                                    <input class="form-check-input"
                                           name="permissions[]" type="checkbox"
                                           value="{{$permission->id}}" id="flexCheckDefault-{{$permission->id}}"
                                        {{in_array($permission->id,$arr_pmss)?'checked':''}}>
                                    <label class="form-check-label" for="flexCheckDefault-{{$permission->id}}">
                                        {{$permission->name}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" type="submit">{{ __('Cập nhật') }}</button>
            </div>
        </div>
    </form>
@endsection

@section('javascript')
    @parent
    <script>
        window.localStorage.setItem('menu-selected', 'permission');
    </script>
@endsection
