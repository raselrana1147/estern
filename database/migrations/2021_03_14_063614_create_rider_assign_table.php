<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiderAssignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rider_assign', function (Blueprint $table) {
            $table->id();
            $table->integer('pick_up_id')->nullable();
            $table->integer('drop_up_id')->nullable();
            $table->integer('rider_id');
            $table->integer('pick_up_cost')->nullable();
            $table->integer('drop_up_cost')->nullable();
            $table->date('date');
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
        Schema::dropIfExists('rider_assign');
    }
}
