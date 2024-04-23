<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->timestamp('date_of_birth');
            $table->integer('gender');
            $table->string('address');
            $table->integer('active');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        //categories
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->unsignedBigInteger('parent_id');
            $table->string('image');
            $table->integer('active');
            $table->timestamps();
            $table->softDeletes();
        });

        //sizes
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('type');
            $table->unsignedBigInteger('size_product');
            $table->integer('active');
            $table->timestamps();
            $table->softDeletes();
        });

        //colors
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('color');
            $table->unsignedBigInteger('color_product');
            $table->integer('active');
            $table->timestamps();
            $table->softDeletes();
        });

        //sales
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->integer('type');
            $table->string('code');
            $table->integer('percent');
            $table->timestamps();
            $table->softDeletes();
        });

        //products
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->string('name');
            $table->string('slug');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('product_size');
            $table->unsignedBigInteger('product_color');
            $table->unsignedBigInteger('sale_id');
            $table->string('image');
            $table->integer('price');
            $table->integer('qty');
            $table->text('detail');
            $table->text('introduce');
            $table->integer('best_sale');
            $table->integer('active');
            $table->timestamps();
            $table->softDeletes();
        });

        //product_size
        Schema::create('product_size', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('size_id');
            $table->timestamps();
            $table->softDeletes();
        });

        //product_size
        Schema::create('product_color', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('color_id');
            $table->timestamps();
            $table->softDeletes();
        });

        //orders
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('total_product');
            $table->integer('total_price');
            $table->string('sale');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('customer_address');
            $table->text('customer_note');
            $table->timestamps();
            $table->softDeletes();
        });

        //order_detail
        Schema::create('order_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('sale');
            $table->integer('sold_price');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('sizes');
        Schema::dropIfExists('colors');
        Schema::dropIfExists('sales');
        Schema::dropIfExists('products');
        Schema::dropIfExists('product_size');
        Schema::dropIfExists('product_color');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('order_detail');
    }
};
