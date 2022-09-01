<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToUniqueInBac extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bacs', function(Blueprint $table) {
            $table->dropUnique('bacs_year_branch_group_id_unique');
            $table->unique(['year', 'branch_group_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bacs', function(Blueprint $table) {
            $table->dropUnique('bacs_year_branch_group_id_type_unique');
            $table->unique(['year', 'branch_group_id']);
        });
    }
}
