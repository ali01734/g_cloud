<?php

use Illuminate\Database\Migrations\Migration;
use nataalam\Models\BacExamFile;

class ChangeBacTypeEnum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $surroundWtQuotes = function($str) {
            return "'$str'";
        };

        $types = join(',', array_map($surroundWtQuotes, BacExamFile::$types));

        DB::statement('ALTER TABLE bac_exam_files '.
            "CHANGE COLUMN type type ENUM($types)"
        );
    }


    public function down() {}
}
