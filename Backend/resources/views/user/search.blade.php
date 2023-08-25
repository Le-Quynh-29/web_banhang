<form action="" method="GET" id="search-form" class="row row-cols-lg-auto g-3 align-items-center mb-4">
    <div class="col-xlg-1 col-xl-2 col-sm-12">
        <span class="badge badge-success">Tìm kiếm theo</span>
    </div>
    <div class="col-xlg-2 col-xl-3 col-sm-4">
        <select class="form-select" name="search_by" id="search_by">
            <option value="username" <?= request()->search_by == 'username' ? 'selected' : '' ?>>Tên đăng nhập</option>
            <option value="fullname" <?= request()->search_by == 'fullname' ? 'selected' : '' ?>>Tên người dùng</option>
            <option value="email" <?= request()->search_by == 'email' ? 'selected' : '' ?>>Email</option>
            <option value="phone_number" <?= request()->search_by == 'phone_number' ? 'selected' : '' ?>>Số điện thoại
            </option>
            <option value="role" <?= request()->search_by == 'role' ? 'selected' : '' ?>>Vai trò</option>
            <option value="active" <?= request()->search_by == 'active' ? 'selected' : '' ?>>Trạng thái</option>
        </select>
    </div>
    <div class="col-xlg-3 col-xl-4 col-sm-8">
        <div class="input-group input-option">
            <input type="text" name="search_text" id="search-text" value="<?= request()->search_text?>"
                   class="form-control <?= (!in_array(request()->search_by , ['role', 'active'])) ? 'active' : '' ?>"
                   placeholder="Nhập tìm kiếm...">
            <select class="form-select <?= request()->search_by == 'active' ? 'active' : '' ?>"
                id="active" name="active">
                <option value="{{\App\Models\User::NO_ACTIVE}}"
                <?= request()->active == \App\Models\User::NO_ACTIVE ? 'selected' : '' ?>>
                    Đã kích hoạt
                </option>
                <option value="{{\App\Models\User::ACTIVE}}"
                <?= request()->active == \App\Models\User::ACTIVE ? 'selected' : '' ?>>
                    Vô hiệu hóa
                </option>
            </select>
            <select id="role" name="role"
                class="form-select <?= request()->search_by == 'role' ? 'active' : '' ?>">
                <option value="{{\App\Models\User::ROLE_ADMIN}}" <?= request()->role == \App\Models\User::ROLE_ADMIN ? 'selected' : '' ?>>
                    Quản trị viên
                </option>
                <option value="{{\App\Models\User::ROLE_CTV}}" <?= request()->role == \App\Models\User::ROLE_CTV ? 'selected' : '' ?>>
                    Cộng tác viên
                </option>
            </select>
            <span class="input-group-append" id="search">
               <button class="btn btn-primary btn-search" type="submit">
                   <i class="far fa-search"></i>
               </button>
            </span>
        </div>
    </div>
</form>
