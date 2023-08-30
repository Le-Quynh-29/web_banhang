<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('discount_vouchers')->truncate();

        $faker = Factory::create();

        $limit = 50;

        for ($i = 1; $i <= $limit; $i++) {
            $type = rand(1, 2);
            $quantity = rand(10, 20);
            $startTime = $faker->dateTime->format('Y-m-d');
            $endTime = date('Y-m-d', strtotime('+' . rand(1, 10) .' day', strtotime($startTime)));
            DB::table('discount_vouchers')->insert([
                'code' => 'MGG000' . $i,
                'name' => $faker->name,
                'type' => $type,
                'description' => $faker->paragraph(6, true),
                'discount' => $this->renderDiscount($type),
                'quantity' => rand(10,20),
                'quantity_used' => $quantity - rand(1, 10),
                'start_time' => $startTime,
                'end_time' => $endTime,
                'user_id' => 1,
                'status' => rand(1,3),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
    }

    protected function renderDiscount($type)
    {
        $discount = rand(5, 50);
        if ($type == 1) {
            $discount = rand(3000, 50000);
        }
        return $discount;
    }
}
