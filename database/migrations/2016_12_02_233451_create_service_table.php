<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->integer('product_id');
            $table->integer('user_id');
            $table->text('customer_fault');
            $table->text('process');
            $table->text('process_proposal');
            $table->text('deposit');
            $table->enum('warranty',array('0','1'));
            $table->enum('status',array('0','1','2'));
            $table->enum('service_detail',array('0','1','2','3'));
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
        Schema::drop('service');
    }
}
