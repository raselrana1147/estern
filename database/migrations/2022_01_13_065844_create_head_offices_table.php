<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeadOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('head_offices', function (Blueprint $table) {
            $table->id();
            $table->string("place")->nullable();
            $table->string("email")->nullable();
            $table->string("website")->nullable();
            $table->string("facebook")->nullable();
            $table->string("youtube")->nullable();
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
        Schema::dropIfExists('head_offices');
    }
}
