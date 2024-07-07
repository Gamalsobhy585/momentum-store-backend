<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function run()
    {
        Order::create([
            'id' => 1,
            'user_id' => 1,
            'firstname' => 'Gamal',
            'lastname' => 'Sobhy',
            'phone' => '+201211085189',
            'email' => 'eng.gamalsobhi@gmail.com',
            'address' => 'Sidi Beshr - Alexandria',
            'city' => 'Alexandria',
            'created_at' => Carbon::parse('2024-07-07 23:18:57'),
            'updated_at' => Carbon::parse('2024-07-07 23:18:57'),
        ]);
    }
}
