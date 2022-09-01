<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddColumnBacType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $bac_types_table = 'bac_types';
        Schema::create($bac_types_table, function(Blueprint $table) {
            $table->increments('id');
            $table->string('label');
        });

        DB::table($bac_types_table)->insert([[
                'label' => 'FIRST_YEAR',
            ], [
                'label' => 'SECOND_YEAR',
            ], [
                'label' => 'NONE'
            ]
        ]);

        Schema::table(
            'branches',
            function(Blueprint $table) use($bac_types_table) {
                $idOfFirstType = DB
                    ::table($bac_types_table)
                    ->select('id')
                    ->first()
                    ->id;

                $table
                    ->unsignedInteger('bac_type_id')
                    ->nullable(false)
                    ->default($idOfFirstType);

                $table
                    ->foreign('bac_type_id')
                    ->references('id')
                    ->on($bac_types_table);
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
