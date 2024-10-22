<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCircularsTable extends Migration
{
    public function up()
    {
        Schema::create('live_circulars', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->text('circular_content'); // CK Editor content
            $table->date('date'); // Date of the circular
            $table->string('circular_attachment')->nullable(); // File attachment
            $table->string('slug')->unique(); // Slug for URL
            $table->foreignId('circular_created_by')->constrained('users'); // User ID
            $table->enum('department', ['COE', 'Principal & Administration']); // Department
            $table->string('circular_id')->unique(); // Unique Circular ID
            $table->string('authorized_signature_person'); // Authorized signature person
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('circulars');
    }
}
