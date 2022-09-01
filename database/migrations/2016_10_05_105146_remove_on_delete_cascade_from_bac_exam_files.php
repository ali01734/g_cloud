<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveOnDeleteCascadeFromBacExamFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Removing ON DELETE CASCADE from BacExamFiles
//        Schema::table('bac_exam_files', function(Blueprint $table) {
//            $table->dropForeign('bacs_branch_group_id_foreign');
//            $table
//                ->unsignedInteger('branch_group_id')
//                ->nullable(true)
//                ->change();
////            $table
////                ->foreign('branch_group_id')
////                ->references('id')
////                ->on('branch_groups')
////                ->onDelete('SET NULL');
//        });
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
