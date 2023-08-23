<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('role_permission')->truncate();

        $pmssAdmins = Permission::PERMISSION_ROLE_ADMIN;
        $pmssCtvs = Permission::PERMISSION_ROLE_CTV;
        $pmssCustomers = Permission::PERMISSION_ROLE_CUSTOMER;

        foreach ($pmssAdmins as $pmssAdmin) {
            DB::table('role_permission')->insert([
                'role_id' => User::ROLE_ADMIN,
                'permission_id' => $pmssAdmin
            ]);
        }

        foreach ($pmssCtvs as $pmssCtv) {
            DB::table('role_permission')->insert([
                'role_id' => User::ROLE_CTV,
                'permission_id' => $pmssCtv
            ]);
        }

        foreach ($pmssCustomers as $pmssCustomer) {
            DB::table('role_permission')->insert([
                'role_id' => User::ROLE_CUSTOMER,
                'permission_id' => $pmssCustomer
            ]);
        }
    }
}
