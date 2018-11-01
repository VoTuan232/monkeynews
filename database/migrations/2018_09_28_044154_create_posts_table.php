<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('body');
            $table->boolean('published')->default(false);
            $table->string('image')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('like')->default('0');
            $table->integer('dislike')->default('0');
            $table->integer('view')->default('0');
            $table->timestamps();
        });

        Schema::table('posts', function ($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function ($table) {
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('posts');
    }
}
