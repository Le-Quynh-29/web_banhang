<form action="" method="GET" id="search-form" class="row row-cols-lg-auto g-3 align-items-center mb-4">
    <div class="col-xlg-1 col-xl-2 col-sm-12">
        <span class="badge badge-success">Tìm kiếm theo</span>
    </div>
    <div class="col-xlg-2 col-xl-2 col-sm-4">
        <select class="form-control" name="search_by" id="search-by-keyword">
            @foreach ($fields as $key => $field)
                <option
                    value="{{ $key }}" {!! app('request')->input('search_by') == $key ? 'selected="selected"' : '' !!}>
                    {!! $field !!}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-xlg-3 col-xl-4 col-sm-8 {{ request()->search_by != 'type' ? '' : 'd-none' }}" id="field-other-type">
        <div class="input-group input-option">
            <input type="text" name="search_text" id="search-text" value="<?= request()->search_text?>"
                   class="form-control <?= (!in_array(request()->search_by, ['type', 'status'])) ? 'active' : '' ?>"
                   placeholder="Nhập tìm kiếm...">
            <select class="form-select <?= request()->search_by == 'status' ? 'active' : '' ?>"
                    id="status" name="status">
                <option value=""<?= request()->status == '' ? 'selected' : '' ?>>Tất cả</option>
                <option value="{{\App\Models\DiscountVoucher::STATUS_START}}"
                <?= request()->active == \App\Models\DiscountVoucher::STATUS_START ? 'selected' : '' ?>>
                    Bắt đầu
                </option>
                <option value="{{\App\Models\DiscountVoucher::STATUS_EXPIRED}}"
                <?= request()->active == \App\Models\DiscountVoucher::STATUS_EXPIRED ? 'selected' : '' ?>>
                    Kết thúc
                </option>
                <option value="{{\App\Models\DiscountVoucher::STATUS_END_OF_USE}}"
                <?= request()->active == \App\Models\DiscountVoucher::STATUS_END_OF_USE ? 'selected' : '' ?>>
                    Hết lượt sử dụng
                </option>
            </select>
            <span class="input-group-append">
               <button class="btn btn-primary btn-search" type="submit">
                   <i class="far fa-search"></i>
               </button>
            </span>
        </div>
    </div>
    <div class="col-xlg-3 col-xl-4 col-sm-8 voucher-type {{ request()->search_by !== 'type' ? 'd-none' : '' }}">
        <select class="form-select <?= request()->search_by == 'type' ? 'active' : '' ?>"
                id="type" name="type">
            <option value=""<?= request()->type == '' ? 'selected' : '' ?>>Tất cả</option>
            <option value="{{\App\Models\DiscountVoucher::TYPE_MONEY}}"
            <?= request()->type == \App\Models\DiscountVoucher::TYPE_MONEY ? 'selected' : '' ?>>
                Giảm tiền
            </option>
            <option value="{{\App\Models\DiscountVoucher::TYPE_PERCENT}}"
            <?= request()->type == \App\Models\DiscountVoucher::TYPE_PERCENT ? 'selected' : '' ?>>
                Giảm phần trăm
            </option>
        </select>
    </div>
    <div class="col-xlg-1 col-xl-2 col-sm-6 voucher-type {{ request()->search_by !== 'type' ? 'd-none' : '' }}">
        <input type="number" name="start_discount" class="form-control" id="start-discount" placeholder="Từ"
               value="<?= request()->start_discount?>"/>
    </div>
    <div class="col-xlg-1 col-xl-2 col-sm-6 voucher-type {{ request()->search_by !== 'type' ? 'd-none' : '' }}">
        <div class="input-group input-option">
            <input type="number" name="end_discount" class="form-control active" id="end-discount" placeholder="Đến"
                   value="<?= request()->end_discount?>"/>
            <span class="input-group-append">
               <button class="btn btn-primary btn-search" type="submit">
                   <i class="far fa-search"></i>
               </button>
            </span>
        </div>
    </div>
</form>
