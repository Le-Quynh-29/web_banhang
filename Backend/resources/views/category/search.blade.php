<form action="" method="GET" id="search-form" class="row row-cols-lg-auto g-3 align-items-center mb-4">
    <div class="col-xlg-1 col-xl-2 col-sm-12">
        <span class="badge badge-success">Tìm kiếm theo</span>
    </div>
    <div class="col-xlg-2 col-xl-3 col-sm-4">
        <select class="form-select" name="search_by" id="search_by">
            <option value="code" <?= request()->search_by == 'code' ? 'selected' : '' ?>>Mã code</option>
            <option value="name" <?= request()->search_by == 'name' ? 'selected' : '' ?>>Tên danh mục</option>
        </select>
    </div>
    <div class="col-xlg-3 col-xl-4 col-sm-8">
        <div class="input-group input-option">
            <input type="text" name="search_text" id="search-text" value="<?= request()->search_text?>"
                   class="form-control active"
                   placeholder="Nhập tìm kiếm...">
            <span class="input-group-append" id="search">
               <button class="btn btn-primary btn-search" type="submit">
                   <i class="far fa-search"></i>
               </button>
            </span>
        </div>
    </div>
</form>
