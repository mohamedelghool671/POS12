<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class FlowerProductsSeeder extends Seeder
{
    public function run(): void
    {
        // إنشاء التصنيفات
        $categories = [
            'Red Rose' => Category::create(['name' => 'الورد الأحمر'])->id,
            'Sunflower' => Category::create(['name' => 'دوار الشمس'])->id,
            'Cherry Blossom' => Category::create(['name' => 'زهرة الكرز'])->id,
            'Tulip' => Category::create(['name' => 'التوليب'])->id,
            'Hydrangea' => Category::create(['name' => 'الهيدرانجيا'])->id,
            'Safflower' => Category::create(['name' => 'القُرطم'])->id,
            'Chrysanthemum' => Category::create(['name' => 'الأقحوان'])->id,
        ];

        // إضافة المنتجات (ما عدا اللافندر)
        Product::insert([
            [
                'name' => 'الورد الأحمر (Red Rose)',
                'description' => 'رمز الحب الكلاسيكي، وردة حمراء جميلة مثالية للتعبير عن مشاعر العشق في المناسبات الخاصة.',
                'price' => 25,
                'purchase_price' => 35,
                'count' => 10,
                'image' => 'red_rose.jpg',
                'category_id' => $categories['Red Rose'],
            ],
            [
                'name' => 'دوار الشمس (Sunflower)',
                'description' => 'زهرة مليئة بالطاقة الإيجابية والفرح، لونها الأصفر الساطع يضيف لمسة مشرقة لأي مكان.',
                'price' => 120,
                'purchase_price' => 150,
                'count' => 10,
                'image' => 'sunflower.jpg',
                'category_id' => $categories['Sunflower'],
            ],
            [
                'name' => 'زهرة الكرز (Cherry Blossom)',
                'description' => 'زهرة ناعمة وأنيقة، مستوحاة من الطبيعة اليابانية، مناسبة لأجواء الهدوء والرقة.',
                'price' => 145,
                'purchase_price' => 180,
                'count' => 10,
                'image' => 'cherry_blossom.jpg',
                'category_id' => $categories['Cherry Blossom'],
            ],
            [
                'name' => 'التوليب (Tulip)',
                'description' => 'زهرة بسيطة وأنيقة، متوفرة بألوان متعددة تناسب كل الأذواق والمناسبات.',
                'price' => 160,
                'purchase_price' => 200,
                'count' => 10,
                'image' => 'tulip.jpg',
                'category_id' => $categories['Tulip'],
            ],
            [
                'name' => 'الهيدرانجيا (Hydrangea)',
                'description' => 'زهرة فخمة وكبيرة الحجم، مثالية للتزيين في الحفلات والأماكن الراقية.',
                'price' => 210,
                'purchase_price' => 250,
                'count' => 10,
                'image' => 'hydrangea.jpg',
                'category_id' => $categories['Hydrangea'],
            ],
            [
                'name' => 'القُرطم (Safflower)',
                'description' => 'بألوانها البرتقالية المبهجة وشكلها الفريد، تضيف لمسة مميزة على أي باقة.',
                'price' => 80,
                'purchase_price' => 100,
                'count' => 10,
                'image' => 'safflower.jpg',
                'category_id' => $categories['Safflower'],
            ],
            [
                'name' => 'الأقحوان (Chrysanthemum)',
                'description' => 'زهور متعددة الألوان، تعبر عن السعادة والتنوع، مثالية لتجميعات الورود.',
                'price' => 100,
                'purchase_price' => 130,
                'count' => 10,
                'image' => 'chrysanthemum.jpg',
                'category_id' => $categories['Chrysanthemum'],
            ],
        ]);
    }
}
