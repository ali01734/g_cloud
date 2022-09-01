<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DefaultTimestamps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach(['lessons', 'exercises', 'comments', 'bac_exam_files'] as $table)
            $this->setCreatedAtDefault($table);
    }

    private function setCreatedAtDefault($table) {
        DB::statement(
            "ALTER TABLE `$table` MODIFY `created_at` " .
            'TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP;'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
