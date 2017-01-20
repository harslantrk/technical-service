<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_payment',function (Blueprint $table){
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('product_id');
            $table->integer('service_id');
            $table->string('quantity');
            $table->string('kdv');
            $table->string('total');
            $table->string('detail');
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
        Schema::drop('service_payment');
    }
}
