<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use nataalam\Models\BacExamFile;

class LinkBacExamFileWithBranches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $pivotTable = 'bac_exam_file_branch';
        $bacFk = 'bac_exam_file_id';
        $branchFk = 'branch_id';

        Schema::create(
            $pivotTable,
            function(Blueprint $table) use($bacFk, $branchFk) {

                $table->unsignedInteger($bacFk);
                $table->unsignedInteger($branchFk);

                $table
                    ->foreign($bacFk)
                    ->references('id')
                    ->on('bac_exam_files')
                    ->onDelete('cascade');

                $table
                    ->foreign($branchFk)
                    ->references('id')
                    ->on('branches')
                    ->onDelete('cascade');

                $table->primary([$bacFk, $branchFk]);
            }
        );

        DB::transaction(function() use($pivotTable, $bacFk, $branchFk) {
            $bacs = DB::table('bac_exam_files')->select('*')->get();
            foreach ($bacs as $bacFile) {

                $branches = DB::table('branches as br')
                    ->join(
                        'branch_branch_group as bbg',
                        'br.id',
                        '=',
                        'bbg.branch_id'
                    )
                    ->join(
                        'bac_exam_files as bef',
                        'bef.branch_group_id',
                        '=',
                        'bbg.branch_group_id'
                    )
                    ->where('bef.id', '=', $bacFile['id'])
                    ->get();

                foreach($branches as $branch) {
                    DB::table($pivotTable)->insert([
                        $bacFk => $bacFile->id,
                        $branchFk => $branch->id,
                    ]);
                }
            }
        });

        Schema::table('bac_exam_files', function(Blueprint $table) {
            $table->dropUnique('bacs_year_branch_group_id_type_unique');
            $table->dropForeign('bacs_branch_group_id_foreign');
            $table->dropColumn('branch_group_id');
        });

        DB::table('branch_groups')->delete();
        Schema::drop('branch_branch_group');
        Schema::drop('branch_groups');
    }

    /**
     * Reverse the migrations.
     *bac
     * @return void
     */
    public function down()
    {

    }
}
