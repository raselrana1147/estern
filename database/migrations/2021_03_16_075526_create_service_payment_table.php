<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_payment', function (Blueprint $table) {
            $table->id();
            $table->string('service_id');
            $table->integer('customer_id');
            $table->string('payment_type');
            $table->string('mobile');
            $table->string('transaction_id');
            $table->tinyInteger('payment_status');
            $table->date('payment_date');
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
        Schema::dropIfExists('service_payment');
    }
}
