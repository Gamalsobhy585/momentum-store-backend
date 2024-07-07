<?php


namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'id' => 1,
            'name' => 'Gamal17',
            'email' => 'eng.gamalsobhi@gmail.com',
            'password' => Hash::make('Gamal2022'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::factory()->count(1)->create();
    }
}
