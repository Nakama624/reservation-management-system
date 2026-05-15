<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ContactStatus;

class ContactStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactStatus::create([
            'status' => '未対応',
        ]);

        ContactStatus::create([
            'status' => '対応中',
        ]);

        ContactStatus::create([
            'status' => '対応済み',  //現金を想定
        ]);
    }
}
