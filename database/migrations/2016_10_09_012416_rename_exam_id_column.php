<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameExamIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_exam_file', function(Blueprint $table) {
            $table->dropForeign('course_exam_exam_id_foreign');
            $table->renameColumn('exam_id', 'exam_file_id');
            $table
                ->foreign('exam_file_id')
                ->references('id')
                ->on('exam_files')
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
        Schema::table('course_exam_file', function(Blueprint $table) {
            $table->dropForeign(['exam_file_id']);
            $table->renameColumn('exam_file_id', 'exam_id');
            $table
                ->foreign('exam_id')
                ->references('id')
                ->on('exam_files')
                ->onDelete('cascade');

        });
    }
}
