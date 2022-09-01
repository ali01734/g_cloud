<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use nataalam\Models\Course;

class AlterCoursesNullableLevelId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // make level_id column nullable
        Schema::table('courses', function(Blueprint $table) {
            $table
                ->unsignedInteger('level_id')
                ->nullable(true)
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // make level_id column non nullable
        Schema::table('courses', function(Blueprint $table) {
            $table
                ->unsignedInteger('level_id')
                ->nullable(false)
                ->change();
        });
    }
}
