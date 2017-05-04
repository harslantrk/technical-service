<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order',function (Blueprint $table){
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('customer_id');
            $table->integer('user_id');
            $table->integer('quantity');
            $table->float('price');
            $table->string('detail');
            $table->integer('status');
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
        Schema::drop('order');
    }
}
