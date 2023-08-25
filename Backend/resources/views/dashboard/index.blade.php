@extends('layouts.app')

@section('header')
    <div class="container-fluid header-menu">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item active"><span>Dashboard</span></li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header"> Dashboard</div>
        <div class="card-body">

        </div>
    </div>
@endsection

@section('javascript')
    <script>
        window.localStorage.setItem('menu-selected', 'dashboard');
    </script>
@endsection
