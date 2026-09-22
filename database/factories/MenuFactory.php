<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Menu>
 */
class MenuFactory extends Factory
{
    private static array $menuItems = [
        'Nasi Sambel Ayam' => ['price' => 15000, 'description' => 'Nasi putih dengan sambel ayam khas'],
        'Nasi Sambel Lele' => ['price' => 12000, 'description' => 'Nasi putih dengan sambel lele goreng'],
        'Nasi Sambel Tahu' => ['price' => 10000, 'description' => 'Nasi putih dengan sambel tahu goreng'],
        'Nasi Sambel Tempe' => ['price' => 10000, 'description' => 'Nasi putih dengan sambel tempe goreng'],
        'Nasi Sambel Telor' => ['price' => 11000, 'description' => 'Nasi putih dengan sambel telur goreng'],
        'Nasi Kotak' => ['price' => 18000, 'description' => 'Nasi kotak untuk pesanan katering'],
        'Tumpeng' => ['price' => 250000, 'description' => 'Tumpeng nasi kuning untuk acara'],
    ];

    public function definition(): array
    {
        $name = fake()->randomElement(array_keys(self::$menuItems));
        $menu = self::$menuItems[$name];

        return [
            'category_id' => Category::factory(),
            'name' => $name,
            'description' => $menu['description'],
            'price' => $menu['price'],
            'status_ketersediaan' => fake()->boolean(90),
        ];
    }
}
