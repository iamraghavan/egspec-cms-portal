<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add new fields
            $table->string('department')->after('password'); // User's department
            $table->enum('role', [
                'Professor & Head',
                'Professor',
                'Assistant Professor',
                'Associate Professor',
                'Associate Professor & Head',
                'Assistant Professor & Head',
                'Lab Assistant',
                'Administrative Assistant'
            ])->after('department'); // User's role
            $table->enum('title', ['Mr', 'Mrs', 'Miss', 'Ms', 'Prof', 'Dr'])->after('role'); // User's title
            $table->string('google_id')->nullable()->after('title'); // Google ID for social login
            $table->string('facebook_id')->nullable()->after('google_id'); // Facebook ID for social login
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the fields if rolling back
            $table->dropColumn(['department', 'role', 'title', 'google_id', 'facebook_id']);
        });
    }
}
