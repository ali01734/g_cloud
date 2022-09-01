<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function(Blueprint $table) {
            $table->increments('id');
            $table->text('text');
            $table->timestamps();
            $table->boolean('reporting_blocked')->default(false);

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('replyTo')->nullable(true);
            $table->unsignedInteger('exercise_id')->nullable(true);
            $table->unsignedInteger('lesson_id')->nullable(true);
            $table->unsignedInteger('bac_subject_id')->nullable(true);
            $table->unsignedInteger('regional_subject_id')->nullable(true);

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table
                ->foreign('replyTo')
                ->references('id')
                ->on('comments')
                ->onDelete('cascade');

            $table
                ->foreign('exercise_id')
                ->references('id')
                ->on('exercises')
                ->onDelete('cascade');

            $table
                ->foreign('lesson_id')
                ->references('id')
                ->on('lessons')
                ->onDelete('cascade');

            $table
                ->foreign('bac_subject_id')
                ->references('id')
                ->on('subjects')
                ->onDelete('cascade');

            $table
                ->foreign('regional_subject_id')
                ->references('id')
                ->on('subjects')
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
        Schema::drop('comments');
    }
}
