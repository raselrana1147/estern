<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('stock_category_id');
            $table->integer('stock_brand_id');
            $table->integer('stock_model_id');
            $table->integer('branch_office_id');
            $table->string('quality');
            $table->tinyInteger('available')->default(0)->comment('0=available,1=unavailable');
            $table->string('color');
            $table->string('variation');
            $table->string('quantity');
            $table->float('purchase_price');
            $table->float('retail_price');
            $table->float('whole_sale_price');
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
        Schema::dropIfExists('stocks');
    }
}
