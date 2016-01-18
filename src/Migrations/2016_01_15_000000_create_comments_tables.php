<?php

use Illuminate\Database\Migrations\Migration;
use \jlourenco\base\Database\Blueprint;

class CreateCommentsTables extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('Comment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent')->unsigned()->nullable();
            $table->text('comment');

            $table->morphs("entity");
            $table->timestamps();
            $table->softDeletes();
            $table->creation();

            $table->foreign('parent')->references('id')->on('Comment');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::drop('Comment');

    }

}
