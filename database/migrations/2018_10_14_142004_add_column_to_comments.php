<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->integer('parent_id')->after('user_id')->nullable()->unsigned();
            $table->integer('commentable_id')->after('parent_id')->unsigned();
            $table->string('commentable_type')->after('commentable_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('parent_id');
            $table->dropColumn('commentable_id');
            $table->dropColumn('commentable_type');
        });
    }
}
