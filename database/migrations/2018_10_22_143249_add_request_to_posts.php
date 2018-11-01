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
            $table->integer('request')->after('view')->default(0);
            $table->dateTime('requested_at')->after('request')->nullable();
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
