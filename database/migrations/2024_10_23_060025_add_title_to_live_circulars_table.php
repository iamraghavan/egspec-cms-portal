<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleToLiveCircularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('live_circulars', function (Blueprint $table) {
            $table->string('title', 90)->after('id'); // Adjust 'after' to the column where you want to place 'title'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('live_circulars', function (Blueprint $table) {
            $table->dropColumn('title');
        });
    }
}