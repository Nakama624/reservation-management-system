<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PaymentMethod::create([
            'payment_method' => 'クレジットカード',
        ]);

        PaymentMethod::create([
            'payment_method' => '銀行振込み',
        ]);

        PaymentMethod::create([
            'payment_method' => '現地払い',  //現金を想定
        ]);

    }
}
