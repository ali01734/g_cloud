<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBacsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bacs', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->enum('type', ['regional', 'national', 'rattrapage']);
            $table
                ->unsignedInteger('year')
                ->unique();

            $table->unsignedInteger('subject_id');
            $table->unsignedInteger('branch_group_id');

            $table
                ->foreign('subject_id')
                ->references('id')
                ->on('subjects')
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
        Schema::drop('bacs');
    }
}
