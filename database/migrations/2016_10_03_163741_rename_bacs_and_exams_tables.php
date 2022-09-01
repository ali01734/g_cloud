<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameBacsAndExamsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('bacs', 'bac_exam_files');
        Schema::rename('exams', 'exam_files');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('bac_exam_files', 'bacs');
        Schema::rename('exam_files', 'exams');
    }
}
