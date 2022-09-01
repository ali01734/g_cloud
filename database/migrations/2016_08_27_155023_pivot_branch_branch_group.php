<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PivotBranchBranchGroup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_branch_group', function(Blueprint $table) {
            $table->unsignedInteger('branch_id');
            $table->unsignedInteger('branch_group_id');

            $table
                ->foreign('branch_id')
                ->references('id')
                ->on('branches')
                ->onDelete('cascade');

            $table
                ->foreign('branch_group_id')
                ->references('id')
                ->on('branch_groups')
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
        Schema::drop('branch_branch_group');
    }
}
