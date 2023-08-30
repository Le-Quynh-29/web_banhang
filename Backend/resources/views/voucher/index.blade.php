@extends('layouts.app')

@section('header')
    <div class="container-fluid header-menu">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
                <li class="breadcrumb-item"><span>Dữ liệu</span></li>
                <li class="breadcrumb-item active"><span>Quản lý mã giảm giá</span></li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            <h4>Quản lý mã giảm giá</h4>
            <a href="{{route('voucher.create')}}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                Thêm mới
            </a>
        </div>
        <div class="card-body">
            @include('voucher.search',['fields' => [
                            'code' => 'Mã giảm giá',
                            'name' => 'Tên',
                            'type' => 'Loại mã',
                            'status' => 'Trạng thái'
                        ]])
            <div class="row mb-3">
                <div class="col-12">
                    <div class="float-left">
                        <h5><span class="float-left">Tổng số: </span>&nbsp;
                            <strong>{!! ShopHelper::numberFormat($vouchers->total()) !!}</strong>
                        </h5>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center">
                            <a data-field="discount_vouchers.id" class="laravel-sort">ID</a>
                        </th>
                        <th scope="col" class="text-center">
                            <a data-field="discount_vouchers.code" class="laravel-sort">Mã</a>
                        </th>
                        <th scope="col" class="text-center">
                            <a data-field="discount_vouchers.name" class="laravel-sort">Tên</a>
                        </th>
                        <th scope="col" class="text-center">
                            <a data-field="discount_vouchers.type" class="laravel-sort">Loại</a>
                        </th>
                        <th scope="col" class="text-center">
                            <a data-field="discount_vouchers.discount" class="laravel-sort">Mức giảm</a>
                        </th>
                        <th scope="col" class="text-center">
                            <a data-field="discount_vouchers.status" class="laravel-sort">Trạng thái</a>
                        </th>
                        <th scope="col" class="text-center">
                            <a data-field="discount_vouchers.start_time" class="laravel-sort">Ngày bắt đầu</a>
                        </th>
                        <th scope="col" class="text-center">
                            <a data-field="discount_vouchers.end_time" class="laravel-sort">Ngày kết thúc</a>
                        </th>
                        <th scope="col" class="text-center">
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($vouchers as $voucher)
                        <tr>
                            <td class="text-center width-50">
                                <a class="cl-blue" href="{{ route('voucher.show', $voucher->id) }}"
                                   data-toggle="tooltip"
                                   data-coreui-placement="bottom"
                                   data-coreui-original-title="Chi tiết">{!!$voucher->id!!}</a>
                            </td>
                            <td class="text-break text-truncate max-width-80">
                                <a class="cl-blue"
                                   data-toggle="tooltip"
                                   data-coreui-placement="bottom"
                                   data-coreui-original-title="Chi tiết"
                                   href="{{ route('voucher.show', $voucher->id) }}">{!!$voucher->code!!}</a>
                            </td>
                            <td class="text-break text-truncate max-width-250">{!!$voucher->name!!}</td>
                            <td class="text-break max-width-100">{!!$voucher->formatType()!!}</td>
                            <td class="text-center">{!! ShopHelper::numberFormat($voucher->discount) !!}</td>
                            <td class="text-center text-break">{!!$voucher->formatStatus()!!}</td>
                            <td class="text-center text-break">{!! ShopHelper::formatTime($voucher->start_time) !!}</td>
                            <td class="text-center text-break">{!! ShopHelper::formatTime($voucher->end_time) !!}</td>
                            <td class="width-80">
                                <div class="d-flex justify-content-between">
                                    <a class="cl-blue" data-toggle="tooltip" data-coreui-placement="top"
                                       data-coreui-title="Cập nhật" href="{{route('voucher.edit',$voucher->id)}}">
                                        <i class="p-r fas fa-edit fa-lg"></i>
                                    </a>
                                    <form method="POST" action="{{ route('voucher.destroy', $voucher->id) }}">
                                        @method('delete')
                                        @csrf
                                        <a data-toggle="tooltip" data-id="{{$voucher->id}}" data-coreui-placement="top"
                                           data-coreui-title="Xóa" class="modal-confirm" href="javascript:;">
                                            <i class="fas fa-trash fa-lg cl-red"></i>
                                        </a>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">Không có dữ liệu</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <div class="pagination">
                {{ $vouchers->appends(request()->input())->render() }}
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        window.localStorage.setItem('menu-selected', 'voucher');
    </script>
    // @vite('resources/js/modal-confirm.js')
    @vite('resources/js/voucher/index.js')
@endsection
