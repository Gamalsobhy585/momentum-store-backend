<?php
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'phone' => '+201' . $this->faker->randomNumber(8, true),
            'email' => $this->faker->safeEmail,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
        ];
    }
}
