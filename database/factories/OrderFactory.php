<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tracking_number' => $this->faker->word . "_" . $this->faker->word . "_" . $this->faker->word,
            'customer_contact' => $this->faker->unique()->email,
            'amount' => $this->faker->numberBetween(1, 17),
            'sales_tax' => $this->faker->numberBetween(1, 7),
            'paid_total' => $this->faker->numberBetween(1, 1000),
            'total' => $this->faker->numberBetween(1, 1000),
            'discount' => $this->faker->numberBetween(1, 100) ,
            'shipping_address' => $this->faker->address(),
            'delivery_fee' => $this->faker->numberBetween(1, 100),
            'delivery_time' => $this->faker->numberBetween(1, 100) . "H",
            'customer_id'=>$this->faker->numberBetween(1,100)
        ];
    }
}
