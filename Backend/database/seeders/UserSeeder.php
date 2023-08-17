<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();

        DB::table('users')->insert([
            'username' => 'Admin',
            'fullname' => 'Administrator',
            'email' => 'admin@gmail.com',
            'gender' => 0,
            'role' => 1,
            'active' => 1,
            'password' => Hash::make('12345678'),
            'password_raw' => '12345678',
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);
    }
}
