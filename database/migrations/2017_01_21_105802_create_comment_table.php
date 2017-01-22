<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment',function (Blueprint $table){
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('user_id');
            $table->enum('status',[0,1]);
            $table->integer('positive_comment');
            $table->integer('negative_comment');
            $table->text('comment');
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
        Schema::drop('comment');
    }
}
