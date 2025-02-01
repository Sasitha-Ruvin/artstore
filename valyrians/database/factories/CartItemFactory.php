<?php

namespace Database\Factories;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = CartItem::class;
    public function definition(): array
    {
        return [

            'cart_id'=>Cart::factory(),
            'product_id'=>Product::factory(),
            //
        ];
    }
}
