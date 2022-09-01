<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use nataalam\Models\Course;

class AlterCoursesAddForeignSubjectId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function(Blueprint $table){
            $table->unsignedInteger('subject_id')->nullable(true);
        });

        $courses = Course::all();

        foreach($courses as $course) {
            $course->subject_id = $course->level->subject->id;
            $course->save();
        }

        Schema::table('courses', function(Blueprint $table) {
            $table
                ->unsignedInteger('subject_id')
                ->nullable(false)
                ->change();
            $table
                ->foreign('subject_id')
                ->references('id')
                ->on('subjects')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function(Blueprint $table) {
            $table->dropForeign('courses_subject_id_foreign');
            $table->dropColumn('subject_id');
        });
    }
}
