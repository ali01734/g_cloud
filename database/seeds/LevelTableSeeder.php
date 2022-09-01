<?php

use Illuminate\Database\Seeder;
use nataalam\Models\Level;
use nataalam\Models\Subject;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = factory(Level::class, 20)->make();

        $levels->get(0)->name = config('app.first_bac_level_name');
        $levels->get(1)->name = config('app.second_bac_level_name');

        Level::insert($levels->toArray());
    }
}
