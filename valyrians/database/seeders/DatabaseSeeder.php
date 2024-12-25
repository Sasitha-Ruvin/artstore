<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create users
        $users = User::factory(10)->create();

        // Create categories
        $categories = Category::factory(5)->create();

        // Create products and associate them with random categories
        $products = Product::factory(20)->create()->each(function ($product) use ($categories) {
            $product->category()->associate($categories->random())->save();
        });

        // Create carts for users
        $users->each(function ($user) use ($products) {
            // Create a Cart for each User
            $cart = Cart::factory()->create(['user_id' => $user->id]);

            // Add between 1 and 5 CartItems for each Cart
            $numCartItems = rand(1, 5);
            for ($i = 0; $i < $numCartItems; $i++) {
                // Associate CartItem with random product
                CartItem::factory()->create([
                    'cart_id' => $cart->id,
                    'product_id' => $products->random()->id,  // Randomly associate with any product
                ]);
            }
        });

        // Create orders for users
        $users->each(function ($user) use ($products) {
            // Create an Order for the user with a random status
            $orderStatus = rand(0, 1) ? 'completed' : 'pending';
            $order = Order::factory()->create([
                'user_id' => $user->id,
                'status' => $orderStatus,
                'total_price' => rand(100, 500)  // Random total price between 100 and 500
            ]);

            // Add between 1 and 3 OrderItems for each Order
            $numOrderItems = rand(1, 3);
            for ($i = 0; $i < $numOrderItems; $i++) {
                // Randomly associate OrderItem with product and set quantity and price
                OrderItem::factory()->create([
                    'order_id' => $order->id,
                    'product_id' => $products->random()->id,  // Random product
                    'quantity' => rand(1, 2),  // Random quantity between 1 and 2
                    'price' => rand(20, 200)  // Random price for the order item
                ]);
            }
        });
    }
}
