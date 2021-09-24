<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\Order_product;
use App\Models\Product;
use App\Models\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(100)->create();
        Category::factory(100)->create();
        Product::factory(100)->create();
        Order::factory(100)->create();
        Order_product::factory(1000)->create();

    }
}
