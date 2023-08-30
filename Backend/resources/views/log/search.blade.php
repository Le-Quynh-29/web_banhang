<form action="" method="GET" class="row-cols-lg-auto g-3 align-items-center mb-4">
    <div class="row pb-3">
        <div class="col-12">
            <span class="badge badge-success">Tìm kiếm theo</span>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-xlg-2 col-xl-2 col-sm-12">
            <div class="form-group">
                <label for="search_user_id">Tài khoản</label>
                <input class="form-control" name="search_user_id" id="search_user_id"/>
            </div>
        </div>

        <div class="col-xlg-2 col-xl-2 col-sm-6">
            <div class="form-group">
                <label for="start_date">Từ ngày</label>
                <input type="date" class="form-control" id="start_date" name="start_date" autocomplete="off"
                       value="{!! app('request')->input('start_date') !!}" placeholder="DD/MM/YYYY">
            </div>
        </div>

        <div class="col-xlg-2 col-xl-2 col-sm-6">
            <div class="form-group">
                <label for="end_date">Đến ngày</label>
                <input type="date" class="form-control" id="end_date" name="end_date" autocomplete="off"
                       value="{!! app('request')->input('end_date') !!}" placeholder="DD/MM/YYYY">
            </div>
        </div>

        <div class="col-xlg-2 col-xl-2 col-sm-4">
            <label for="search-by-keyword">Tìm kiếm theo</label>
            <select class="form-control" name="search_by" id="search-by-keyword">
                @foreach ($fields as $key => $field)
                    <option value="{{ $key }}" {!! app('request')->input('search_by') == $key ? 'selected="selected"' : '' !!}>
                        {!! $field !!}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-xlg-4 col-xl-4 col-sm-8">
            <div class="form-group">
                <label>Từ khóa</label>
                <div class="input-group input-option">
                    <input class="form-control <?= request()->search_by != null && request()->search_by != 'event' ? 'active' : '' ?>"
                           name="search_text" id="search-text" placeholder="{{ __('Từ khóa') }}"
                           value="{!! app('request')->input('search_text') !!}"/>
                    <select name="module" id="module"
                            class="form-control <?= request()->search_by == 'event' || request()->search_by == null ? 'active' : '' ?>">
                        <option value="" {!! app('request')->input('module') == "" ? 'selected="selected"' : '' !!}>
                            {{ __('Tất cả') }}
                        </option>
                        <option value="DM" {!! app('request')->input('module') == "DM" ? 'selected="selected"' : '' !!}>
                            {{ __('Danh mục') }}
                        </option>
                        <option value="MGG" {!! app('request')->input('module') == "MGG" ? 'selected="selected"' : '' !!}>
                            {{ __('Mã giảm giá') }}
                        </option>
                        <option value="DH" {!! app('request')->input('module') == "DH" ? 'selected="selected"' : '' !!}>
                            {{ __('Đơn hàng') }}
                        </option>
                        <option value="SP" {!! app('request')->input('module') == "SP" ? 'selected="selected"' : '' !!}>
                            {{ __('Sản phẩm') }}
                        </option>
                    </select>
                    <span class="input-group-append">
                        <button class="btn btn-primary btn-search" type="submit">
                            <i class="far fa-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>
</form>
