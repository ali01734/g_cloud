<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class AddInstanceTypeToBacExamFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bac_exam_files', function(Blueprint $table) {
            $table->enum('region', range(1, 12))->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bac_exam_files', function(Blueprint $table) {
           $table->dropColumn('region');
        });
    }
}
