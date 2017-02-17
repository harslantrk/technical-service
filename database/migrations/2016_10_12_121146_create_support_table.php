<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sender_id');
            $table->integer('receiver_id');
            $table->string('title');
            $table->string('detail');
            $table->enum('status',['0','1']);
            $table->enum('read',['0','1']);
            $table->enum('trash',['0','1']);
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
        Schema::drop('support');
    }
}
