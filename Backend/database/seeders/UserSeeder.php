<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
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

        $faker = Factory::create();

        $limit = 50;

        for ($i = 1; $i <= $limit; $i++) {
            DB::table('users')->insert([
                'username' => $faker->firstName,
                'fullname' => $faker->name,
                'email' => $faker->email,
                'gender' => rand(0,1),
                'role' => rand(1,3),
                'active' => rand(0,1),
                'password' => Hash::make('12345678'),
                'password_raw' => '12345678',
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
    }
}
