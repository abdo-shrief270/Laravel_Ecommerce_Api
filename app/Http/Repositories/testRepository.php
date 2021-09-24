<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\testRepositoryInterface;
use App\Models\Product;

class testRepository implements testRepositoryInterface
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->$product = $product;
    }

    public function getAll()
    {
        return Product::get();
    }
}
