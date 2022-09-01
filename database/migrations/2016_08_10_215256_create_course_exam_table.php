<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseExamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_exam', function(Blueprint $table) {
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('exam_id');

            $table->primary(['course_id', 'exam_id']);

            $table
                ->foreign('exam_id')
                ->references('id')
                ->on('exams')
                ->onDelete('cascade');

            $table
                ->foreign('course_id')
                ->references('id')
                ->on('courses')
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
        Schema::drop('course_file');
    }
}
