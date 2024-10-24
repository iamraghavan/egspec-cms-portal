<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCircularsTable extends Migration
{
    public function up()
    {
        Schema::create('live_circulars', function (Blueprint $table) {
            $table->id();
            $table->text('circular_content');
            $table->date('date');
            $table->string('circular_attachment')->nullable();
            $table->string('slug')->unique();
            $table->foreignId('circular_created_by')->constrained('users');
            $table->enum('department', ['COE', 'Principal & Administration']);
            $table->string('circular_id')->unique();
            $table->string('authorized_signature_person');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('circulars');
    }
}