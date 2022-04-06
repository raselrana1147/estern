<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiderInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rider_info', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('nid');
            $table->text('address');
            $table->string('country');
            $table->string('city');
            $table->string('zip');
            $table->string('postal_code');
            $table->string('card_number');
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
        Schema::dropIfExists('rider_info');
    }
}
