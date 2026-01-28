<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<Menu>
     */
    protected $model = Menu::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shop_id' => Shop::factory(),
            'category_id' => Category::factory(),
            'name' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'price' => fake()->numberBetween(100, 5000),
        ];
    }
}
