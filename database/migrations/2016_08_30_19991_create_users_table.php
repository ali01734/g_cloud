<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('school')->nullable(true);
            $table
                ->enum('type', ['normal', 'facebook', 'google'])
                ->default('normal');
            $table->string('social_id')->nullable(true);

            $table->boolean('is_admin');
            $table->rememberToken();
            $table->timestamps();

            $table->unsignedInteger('branch_id')->nullable(true);
            $table->unsignedInteger('level_id')->nullable(true);
            $table->unsignedInteger('city_id')->nullable(true);

            $table
                ->foreign('branch_id')
                ->references('id')
                ->on('branches')
                ->onDelete('set null');

            $table
                ->foreign('level_id')
                ->references('id')
                ->on('levels')
                ->onDelete('set null');

            $table
                ->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
