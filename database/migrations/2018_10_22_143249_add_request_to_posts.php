<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRequestToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('posts', function (Blueprint $table) {
            $table->boolean('request')->after('view')->nullable();
            $table->dateTime('requested_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('request')->after('view')->nullable();
            $table->dropColumn('requested_at')->nullable();
        });
    }
}
