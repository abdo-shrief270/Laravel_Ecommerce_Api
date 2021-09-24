<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('userId');
            $table->timestamps();
        });
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_description');
            $table->timestamps();
        });
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_description');
            $table->text('description');
            $table->float('amount');
            $table->string('image');
            $table->string('slug');
            $table->float('price');
            $table->float('sale_price');
            $table->boolean('in_stock')->default(true);
            $table->boolean('is_taxable')->default(false);
            $table->enum('status', ['publish', 'draft'])->default('publish');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_number')->unique();
            $table->string('customer_contact');
            $table->double('amount');
            $table->double('sales_tax')->nullable();
            $table->double('paid_total')->nullable();
            $table->double('total')->nullable();
            $table->double('discount')->nullable();
            $table->string('shipping_address')->nullable();
            $table->double('delivery_fee')->nullable();
            $table->string('delivery_time')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('users');
            $table->timestamps();
        });
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('products');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_product');
    }
}
