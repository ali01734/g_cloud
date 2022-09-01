
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function(Blueprint $table) {
            $table->timestamps();
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('order')->default(0);
            $table->text('text');
            $table->string('youtube_id')->nullable(true);
            $table
                ->integer('course_id')
                ->unsigned();
            $table
                ->foreign('course_id')
                ->references('id')
                ->on('courses')
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
        Schema::drop('lessons');
    }
}
