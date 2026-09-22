<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    private static array $menus = [
        'Menu Harian' => [
            ['name' => 'Nasi Sambel Ayam', 'description' => 'Nasi putih dengan sambel ayam khas', 'price' => 15000],
            ['name' => 'Nasi Sambel Lele', 'description' => 'Nasi putih dengan sambel lele goreng', 'price' => 12000],
            ['name' => 'Nasi Sambel Tahu', 'description' => 'Nasi putih dengan sambel tahu goreng', 'price' => 10000],
            ['name' => 'Nasi Sambel Tempe', 'description' => 'Nasi putih dengan sambel tempe goreng', 'price' => 10000],
            ['name' => 'Nasi Sambel Telor', 'description' => 'Nasi putih dengan sambel telur goreng', 'price' => 11000],
        ],
        'Paket Katering' => [
            ['name' => 'Nasi Kotak', 'description' => 'Nasi kotak untuk pesanan katering', 'price' => 18000],
            ['name' => 'Tumpeng', 'description' => 'Tumpeng nasi kuning untuk acara', 'price' => 250000],
        ],
    ];

    public function run(): void
    {
        foreach (self::$menus as $categoryName => $items) {
            $category = Category::where('name', $categoryName)->first();

            foreach ($items as $item) {
                Menu::create([
                    'category_id' => $category->id,
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'status_ketersediaan' => true,
                ]);
            }
        }
    }
}
