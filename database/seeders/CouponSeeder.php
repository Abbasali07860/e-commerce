<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Coupon::create([
            'code' => 'DISCOUNT10',
            'type' => 'percent',
            'value' => 10, // 10%
            'expires_at' => now()->addMonth(),
            'status' => 1,
        ]);

        Coupon::create([
            'code' => 'FLAT100',
            'type' => 'fixed',
            'value' => 100, // ₹100 off
            'expires_at' => now()->addMonth(),
            'status' => 1,
        ]);
    }
}
