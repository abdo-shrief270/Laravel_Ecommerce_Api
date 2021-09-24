<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    
    protected $model = Product::class;

   
    public function definition()
    {
        return [
            'name' => $this->faker->word.$this->faker->word,
            'short_description' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'amount' => $this->faker->numberBetween(1,10000),
            'image' => $this->faker->imageUrl(1920, 1080, 'technics',true),
            'category_id'=>$this->faker->randomFloat(null,1,100),
            'slug'=>$this->faker->word."_".$this->faker->word,
            'price'=>$this->faker->numberBetween(10,100000),
            'sale_price'=>$this->faker->numberBetween(10,100000),
            'in_stock'=>$this->faker->randomElement([true, false]),
            'is_taxable'=>$this->faker->randomElement([true, false]),
            'status'=>$this->faker->randomElement(['publish', 'draft']),

        ];
    }
}
