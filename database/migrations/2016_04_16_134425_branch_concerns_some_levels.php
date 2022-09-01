<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BranchConcernsSomeLevels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_level', function(Blueprint $table) {
            $table->integer('branch_id')->unsigned();
            $table
                ->foreign('branch_id')
                ->references('id')
                ->on('branches')
                ->onDelete('cascade');

            $table->integer('level_id')->unsigned();
            $table
                ->foreign('level_id')
                ->references('id')
                ->on('levels')
                ->onDelete('cascade');

            $table->primary(['branch_id', 'level_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('branch_level');
    }
}
