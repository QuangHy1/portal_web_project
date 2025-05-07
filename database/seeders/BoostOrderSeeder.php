<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoostOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        DB::table('boost_orders')->insert([
            [
                'employer_id' => 1,
                'package_id' => 2,
                'package_price' => '800',
                'tnxID' => 'TXN68131BA5182D1',
                'payment_method' => 'Mobile Banking',
                'isActive' => 1,
                'date_purchased' =>now(), // Mua cách đây 2 tiếng
                'date_expired' => $now->copy()->subHours(2)->addDays(30)->toDateTimeString(), // Hết hạn sau 5 ngày kể từ lúc mua
                'created_at' => now(),
                'updated_at' =>now(),
            ],
            [
                'employer_id' => 4,
                'package_id' => 1,
                'package_price' => '300',
                'tnxID' => 'TXN68131CCF77C1B',
                'payment_method' => 'MOMO',
                'isActive' => 1,
                'date_purchased' =>now(), // Mua cách đây 2 tiếng
                'date_expired' => $now->copy()->subHours(2)->addDays(5)->toDateTimeString(), // Hết hạn sau 5 ngày kể từ lúc mua
                'created_at' => now(),
                'updated_at' =>now(),
            ],
            [
                'employer_id' => 2,
                'package_id' => 2,
                'package_price' => '800',
                'tnxID' => 'TXN68131D5E2D2C3',
                'payment_method' => 'Mobile Banking',
                'isActive' => 1,
                'date_purchased' =>now(), // Mua cách đây 2 tiếng
                'date_expired' => $now->copy()->subHours(2)->addDays(30)->toDateTimeString(), // Hết hạn sau 5 ngày kể từ lúc mua
                'created_at' => now(),
                'updated_at' =>now(),
            ],
            [
                'employer_id' => 3,
                'package_id' => 1,
                'package_price' => '300',
                'tnxID' => 'TXN68131CD9A0E43',
                'payment_method' => 'MOMO',
                'isActive' => 1,
                'date_purchased' =>now(), // Mua cách đây 2 tiếng
                'date_expired' => $now->copy()->subHours(2)->addDays(30)->toDateTimeString(), // Hết hạn sau 5 ngày kể từ lúc mua
                'created_at' => now(),
                'updated_at' =>now(),
            ],
            // Bạn có thể thêm các đơn hàng boost khác vào đây nếu cần
        ]);
    }
}
