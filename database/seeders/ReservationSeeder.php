<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservation;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reservation::create([
            'user_id' => 2,
            'schedule_id' => 2,
            'participants' => 2,
            'amount' => 2000,
            'payment_status' => '支払済み',
            'payment_method_id' => 1,
            'paid_at' => now(),
            'is_canceled'=> false,
        ]);

        Reservation::create([
            'user_id' => 2,
            'schedule_id' => 4,
            'participants' => 3,
            'amount' => 3000,
            'payment_status' => '未払い',
            'payment_method_id' => 3,
            'paid_at' => now(),
            'is_canceled'=> true,
        ]);
        Reservation::create([
            'user_id' => 2,
            'schedule_id' => 5,
            'participants' => 3,
            'amount' => 3000,
            'payment_status' => '未払い',
            'payment_method_id' => 3,
            'paid_at' => now(),
            'is_canceled'=> false,
        ]);
        Reservation::create([
            'user_id' => 5,
            'schedule_id' => 2,
            'participants' => 3,
            'amount' => 3000,
            'payment_status' => '未払い',
            'payment_method_id' => 3,
            'paid_at' => null,
            'is_canceled'=> false,
        ]);

        Reservation::create([
            'user_id' => 3,
            'schedule_id' => 4,
            'participants' => 2,
            'amount' => 2800,
            'payment_status' => '支払済み',
            'payment_method_id' => 2,
            'paid_at' => now(),
            'is_canceled'=> false,
        ]);

    }
}
