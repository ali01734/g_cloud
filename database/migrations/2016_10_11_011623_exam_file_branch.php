<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ExamFileBranch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_exam_file', function(Blueprint $table) {
            $table->unsignedInteger('exam_file_id');
            $table->unsignedInteger('branch_id');

            $table
                ->foreign('exam_file_id')
                ->references('id')
                ->on('exam_files')
                ->onDelete('cascade');

            $table
                ->foreign('branch_id')
                ->references('id')
                ->on('branches')
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
        Schema::drop('branch_exam_file');
    }
}
