<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->truncate();

        //Log
        DB::table('permissions')->insert([
            'id' => 1,
            'module' => 'Log',
            'name' => 'Danh sách log',
            'slug' => 'pmss--log-index'
        ]);
        DB::table('permissions')->insert([
            'id' => 2,
            'module' => 'Log',
            'name' => 'Chi tiết log',
            'slug' => 'pmss--log-detail'
        ]);

        //Danh mục
        DB::table('permissions')->insert([
            'id' => 3,
            'module' => 'Danh mục',
            'name' => 'Danh sách danh mục',
            'slug' => 'pmss--category-index'
        ]);
        DB::table('permissions')->insert([
            'id' => 4,
            'module' => 'Danh mục',
            'name' => 'Chi tiết danh mục',
            'slug' => 'pmss--category-detail'
        ]);
        DB::table('permissions')->insert([
            'id' => 5,
            'module' => 'Danh mục',
            'name' => 'Thêm mới danh mục',
            'slug' => 'pmss--category-create'
        ]);
        DB::table('permissions')->insert([
            'id' => 6,
            'module' => 'Danh mục',
            'name' => 'Cập nhật danh mục',
            'slug' => 'pmss--category-update'
        ]);
        DB::table('permissions')->insert([
            'id' => 7,
            'module' => 'Danh mục',
            'name' => 'Xoá nhóm danh mục',
            'slug' => 'pmss--category-delete'
        ]);

        //Người dùng
        DB::table('permissions')->insert([
            'id' => 10,
            'module' => 'Người dùng',
            'name' => 'Danh sách người dùng',
            'slug' => 'pmss--user-index'
        ]);
        DB::table('permissions')->insert([
            'id' => 11,
            'module' => 'Người dùng',
            'name' => 'Chi tiết người dùng',
            'slug' => 'pmss--user-detail'
        ]);
        DB::table('permissions')->insert([
            'id' => 12,
            'module' => 'Người dùng',
            'name' => 'Thêm mới người dùng',
            'slug' => 'pmss--user-create'
        ]);
        DB::table('permissions')->insert([
            'id' => 13,
            'module' => 'Người dùng',
            'name' => 'Cập nhật người dùng',
            'slug' => 'pmss--user-update'
        ]);
        DB::table('permissions')->insert([
            'id' => 14,
            'module' => 'Người dùng',
            'name' => 'Xoá người dùng',
            'slug' => 'pmss--user-delete'
        ]);
        DB::table('permissions')->insert([
            'id' => 15,
            'module' => 'Người dùng',
            'name' => 'Thông tin cá nhân',
            'slug' => 'pmss--user-info'
        ]);
        DB::table('permissions')->insert([
            'id' => 16,
            'module' => 'Người dùng',
            'name' => 'Đổi mật khẩu',
            'slug' => 'pmss--user-change-pass'
        ]);
        DB::table('permissions')->insert([
            'id' => 58,
            'module' => 'Người dùng',
            'name' => 'Cập nhật thông tin cá nhân',
            'slug' => 'pmss--user-info-update'
        ]);

        //Khách hàng
        DB::table('permissions')->insert([
            'id' => 17,
            'module' => 'Khách hàng',
            'name' => 'Danh sách khách hàng',
            'slug' => 'pmss--customer-index'
        ]);
        DB::table('permissions')->insert([
            'id' => 18,
            'module' => 'Khách hàng',
            'name' => 'Chi tiết khách hàng',
            'slug' => 'pmss--customer-detail'
        ]);
        DB::table('permissions')->insert([
            'id' => 19,
            'module' => 'Khách hàng',
            'name' => 'Vô hiệu hóa khách hàng',
            'slug' => 'pmss--customer-delete'
        ]);
        DB::table('permissions')->insert([
            'id' => 22,
            'module' => 'Khách hàng',
            'name' => 'Thông tin cá nhân',
            'slug' => 'pmss--customer-info'
        ]);
        DB::table('permissions')->insert([
            'id' => 23,
            'module' => 'Khách hàng',
            'name' => 'Cập nhật thông tin cá nhân',
            'slug' => 'pmss--customer-info-update'
        ]);
        DB::table('permissions')->insert([
            'id' => 24,
            'module' => 'Khách hàng',
            'name' => 'Đổi mật khẩu',
            'slug' => 'pmss--customer-change-pass'
        ]);
        DB::table('permissions')->insert([
            'id' => 25,
            'module' => 'Khách hàng',
            'name' => 'Danh sách địa chỉ nhận hàng',
            'slug' => 'pmss--customer-list-address'
        ]);
        DB::table('permissions')->insert([
            'id' => 26,
            'module' => 'Khách hàng',
            'name' => 'Tạo mới và cập nhật địa chỉ nhận hàng',
            'slug' => 'pmss--customer-cu-address'
        ]);

        //Mã giảm giá
        DB::table('permissions')->insert([
            'id' => 27,
            'module' => 'Mã giảm giá',
            'name' => 'Danh sách mã giảm giá',
            'slug' => 'pmss--discount-index'
        ]);
        DB::table('permissions')->insert([
            'id' => 28,
            'module' => 'Mã giảm giá',
            'name' => 'Chi tiết mã giảm giá',
            'slug' => 'pmss--discount-detail'
        ]);
        DB::table('permissions')->insert([
            'id' => 29,
            'module' => 'Mã giảm giá',
            'name' => 'Tạo mới mã giảm giá',
            'slug' => 'pmss--discount-create'
        ]);
        DB::table('permissions')->insert([
            'id' => 30,
            'module' => 'Mã giảm giá',
            'name' => 'Cập nhật mã giảm giá',
            'slug' => 'pmss--discount-update'
        ]);
        DB::table('permissions')->insert([
            'id' => 31,
            'module' => 'Mã giảm giá',
            'name' => 'Xoá mã giảm giá',
            'slug' => 'pmss--discount-delete'
        ]);
        DB::table('permissions')->insert([
            'id' => 32,
            'module' => 'Mã giảm giá',
            'name' => 'Danh sách mã giảm giá',
            'slug' => 'pmss--fr-discount'
        ]);

        //Đơn hàng
        DB::table('permissions')->insert([
            'id' => 34,
            'module' => 'Đơn hàng',
            'name' => 'Danh sách đơn hàng',
            'slug' => 'pmss--order-index'
        ]);
        DB::table('permissions')->insert([
            'id' => 35,
            'module' => 'Đơn hàng',
            'name' => 'Chi tiết đơn hàng',
            'slug' => 'pmss--order-detail'
        ]);
        DB::table('permissions')->insert([
            'id' => 36,
            'module' => 'Đơn hàng',
            'name' => 'Cập nhật đơn hàng',
            'slug' => 'pmss--order-update'
        ]);
        DB::table('permissions')->insert([
            'id' => 37,
            'module' => 'Đơn hàng',
            'name' => 'Xóa đơn hàng',
            'slug' => 'pmss--order-delete'
        ]);
        DB::table('permissions')->insert([
            'id' => 38,
            'module' => 'Đơn hàng',
            'name' => 'Danh sách đơn mua',
            'slug' => 'pmss--fr-order-index'
        ]);
        DB::table('permissions')->insert([
            'id' => 39,
            'module' => 'Đơn hàng',
            'name' => 'Thêm mới đơn hàng',
            'slug' => 'pmss--fr-order-create'
        ]);
        DB::table('permissions')->insert([
            'id' => 40,
            'module' => 'Đơn hàng',
            'name' => 'Trạng thái đơn hàng',
            'slug' => 'pmss--fr-order-status'
        ]);
        DB::table('permissions')->insert([
            'id' => 41,
            'module' => 'Đơn hàng',
            'name' => 'Hủy đơn hàng',
            'slug' => 'pmss--fr-order-cancel'
        ]);
        DB::table('permissions')->insert([
            'id' => 42,
            'module' => 'Đơn hàng',
            'name' => 'Đánh giá',
            'slug' => 'pmss--fr-order-review'
        ]);
        DB::table('permissions')->insert([
            'id' => 43,
            'module' => 'Đơn hàng',
            'name' => 'Xác nhận giao dịch',
            'slug' => 'pmss--fr-order-transaction'
        ]);
        DB::table('permissions')->insert([
            'id' => 44,
            'module' => 'Đơn hàng',
            'name' => 'Tính toán đơn hàng',
            'slug' => 'pmss--fr-order-calculate'
        ]);

        //Sản phẩm
        DB::table('permissions')->insert([
            'id' => 45,
            'module' => 'Sản phẩm',
            'name' => 'Danh sách sản phẩm',
            'slug' => 'pmss--product-index'
        ]);
        DB::table('permissions')->insert([
            'id' => 46,
            'module' => 'Sản phẩm',
            'name' => 'Chi tiết sản phẩm',
            'slug' => 'pmss--product-detail'
        ]);
        DB::table('permissions')->insert([
            'id' => 47,
            'module' => 'Sản phẩm',
            'name' => 'Thêm mới sản phẩm',
            'slug' => 'pmss--product-create'
        ]);
        DB::table('permissions')->insert([
            'id' => 48,
            'module' => 'Sản phẩm',
            'name' => 'Cập nhật sản phẩm',
            'slug' => 'pmss--product-update'
        ]);
        DB::table('permissions')->insert([
            'id' => 49,
            'module' => 'Sản phẩm',
            'name' => 'Xoá sản phẩm',
            'slug' => 'pmss--product-delete'
        ]);
        DB::table('permissions')->insert([
            'id' => 50,
            'module' => 'Sản phẩm',
            'name' => 'Danh sách sản phẩm mới',
            'slug' => 'pmss--product-list-new'
        ]);
        DB::table('permissions')->insert([
            'id' => 51,
            'module' => 'Sản phẩm',
            'name' => 'Danh sách sản phẩm ưa thích',
            'slug' => 'pmss--product-list-like'
        ]);
        DB::table('permissions')->insert([
            'id' => 52,
            'module' => 'Sản phẩm',
            'name' => 'Danh sách 1 số sản phẩm khác',
            'slug' => 'pmss--product-list-orther'
        ]);
        DB::table('permissions')->insert([
            'id' => 53,
            'module' => 'Sản phẩm',
            'name' => 'Danh sách sản phẩm tìm kiếm',
            'slug' => 'pmss--product-list-search'
        ]);
        DB::table('permissions')->insert([
            'id' => 54,
            'module' => 'Sản phẩm',
            'name' => 'Danh sách sản phẩm đã xem',
            'slug' => 'pmss--product-list-seen'
        ]);
        DB::table('permissions')->insert([
            'id' => 55,
            'module' => 'Sản phẩm',
            'name' => 'Danh sách sản phẩm đã thích',
            'slug' => 'pmss--product-list-liked'
        ]);
        DB::table('permissions')->insert([
            'id' => 56,
            'module' => 'Sản phẩm',
            'name' => 'Chi tiết sản phẩm',
            'slug' => 'pmss--fr-product-detail'
        ]);
        DB::table('permissions')->insert([
            'id' => 57,
            'module' => 'Sản phẩm',
            'name' => 'Các sản phẩm liên quan',
            'slug' => 'pmss--product-list-related'
        ]);
        DB::table('permissions')->insert([
            'id' => 33,
            'module' => 'Sản phẩm',
            'name' => 'Danh sách các sản phẩm áp dụng mã giảm giá',
            'slug' => 'pmss--product-discount'
        ]);
        DB::table('permissions')->insert([
            'id' => 8,
            'module' => 'Sản phẩm',
            'name' => 'Danh sách sản phẩm theo danh mục',
            'slug' => 'pmss--product-category'
        ]);

        //Dashboard
        DB::table('permissions')->insert([
            'id' => 9,
            'module' => 'Dashboard',
            'name' => 'Dashboard',
            'slug' => 'pmss--dashboard'
        ]);
    }
}
