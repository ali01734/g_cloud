<?php

use Illuminate\Database\Seeder;
use nataalam\Models\Branch;
use nataalam\Models\Level;


class BranchesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branches')->insert(
            factory(Branch::class, 3 * Level::count())
            ->make()
            ->toArray()
        );

        $levelBranchRel = [];

        $branchIds = DB::table('branches')->select('id')->get();
        $levelIds = DB::table('levels')->select('id')->get();

        foreach($levelIds as $levelId) {
            for($i = 0; $i < 3 && !empty($branchIds); $i++) {
                $levelBranchRel[] = [
                    'level_id' => $levelId->id,
                    'branch_id' => $branchIds[0]->id,
                ];
                array_shift($branchIds);
            }
        }

        DB::table('branch_level')->insert($levelBranchRel);
    }
}
