<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('sub_cat_id');
            $table->integer('brand_id');
            $table->string('model');
            $table->string('code');
            $table->string('pro_type');
            $table->string('name');
            $table->string('title');
            $table->text('description');
            $table->text('image')->nullable();
            $table->float('previous_price',11,2)->default(0);
            $table->double('price');
            $table->float('discount',11,2)->default(0);
            $table->integer('quantity');
            $table->string('color');
            $table->string('warranty');
            $table->tinyInteger('status');
            $table->tinyInteger('feature');
            $table->tinyInteger('publish');
            $table->tinyInteger('new_arrival');
            $table->integer('view_count');
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
        Schema::dropIfExists('products');
    }
}
