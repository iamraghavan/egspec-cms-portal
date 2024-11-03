<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTableAddRoleAndIds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Modify the role column if it exists
            if (Schema::hasColumn('users', 'role')) {
                // Change the role column to the new enum values with default
                $table->enum('role', [
                    'Professor & Head',
                    'Professor',
                    'Assistant Professor',
                    'Associate Professor',
                    'Associate Professor & Head',
                    'Assistant Professor & Head',
                    'Lab Assistant',
                    'Administrative Assistant',
                    'No Teaching',
                    'Admin',
                    'Student'
                ])->default('Student')->change();
            } else {
                // If the column doesn't exist, add it
                $table->enum('role', [
                    'Professor & Head',
                    'Professor',
                    'Assistant Professor',
                    'Associate Professor',
                    'Associate Professor & Head',
                    'Assistant Professor & Head',
                    'Lab Assistant',
                    'Administrative Assistant',
                    'No Teaching',
                    'Admin',
                    'Student'
                ])->default('Student')->after('title'); // Add the role column
            }

            // Add new field for staff/student ID
            $table->string('staff_student_id')->nullable()->after('role'); // Field to store staff/student ID
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
            // Drop the new fields if rolling back
            $table->dropColumn(['staff_student_id']);

            // Restore the original role column (if needed)
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
                $table->enum('role', [
                    'Professor & Head',
                    'Professor',
                    'Assistant Professor',
                    'Associate Professor',
                    'Associate Professor & Head',
                    'Assistant Professor & Head',
                    'Lab Assistant',
                    'Administrative Assistant'
                ])->after('title'); // Restore old role column without new values
            }
        });
    }
}
