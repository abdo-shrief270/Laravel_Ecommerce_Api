<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = array();

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function order(){
        return $this->belongsToMany(order::class);

    }
}
