<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('live_events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('date');
            $table->time('time');
            $table->string('venue');
            $table->string('attachment')->nullable();
            $table->string('event_image')->nullable();
            $table->string('slug')->unique();
            $table->unsignedBigInteger('event_created_by');
            $table->string('event_url')->nullable();
            $table->string('department');
            $table->string('event_id')->unique();
            $table->foreign('event_created_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('live_events');
    }
}
