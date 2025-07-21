<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Payment;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // حذف جميع البيانات الموجودة بطريقة آمنة
        Payment::query()->delete();

        // إضافة البيانات الصحيحة
        Payment::create([
            'type' => 'KBZPay',
            'account_number' => '23412341234123',
            'account_name' => 'Jin',
        ]);

        Payment::create([
            'type' => 'WPay',
            'account_number' => '267899853025',
            'account_name' => 'RM',
        ]);

        Payment::create([
            'type' => 'Wave Money',
            'account_number' => '09876543210',
            'account_name' => 'Flower Shop',
        ]);
    }
}
