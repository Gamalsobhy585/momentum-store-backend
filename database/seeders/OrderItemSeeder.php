<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderItem;
use Carbon\Carbon;

class OrderItemSeeder extends Seeder
{
    public function run()
    {
        OrderItem::create([
            'id' => 1,
            'order_id' => 1,
            'product_id' => 1,
            'qty' => 3,
            'price' => 21000.00,
            'created_at' => Carbon::parse('2024-07-07 23:18:57'),
            'updated_at' => Carbon::parse('2024-07-07 23:18:57'),
        ]);

        OrderItem::create([
            'id' => 2,
            'order_id' => 1,
            'product_id' => 10,
            'qty' => 4,
            'price' => 81000.00,
            'created_at' => Carbon::parse('2024-07-07 23:18:57'),
            'updated_at' => Carbon::parse('2024-07-07 23:18:57'),
        ]);
    }
}
