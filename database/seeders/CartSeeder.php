<?php
namespace Database\Seeders;

use App\Models\Cart;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    public function run()
    {
        Cart::factory()->count(2)->create();

        Cart::create([
            'user_id' => 1,
            'product_id' => 1,
            'product_quantity' => 3,
            'price' => 21000.00,
            'created_at' => '2024-07-07 23:02:57',
            'updated_at' => '2024-07-07 23:02:57'
        ]);

        Cart::create([
            'user_id' => 2,
            'product_id' => 10,
            'product_quantity' => 4,
            'price' => 81000.00,
            'created_at' => '2024-07-07 23:03:13',
            'updated_at' => '2024-07-07 23:03:13'
        ]);
    }
}
