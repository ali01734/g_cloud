<?php

use Illuminate\Database\Seeder;
use nataalam\Models\City;

class CitiesTableSeeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        City::insert(factory(City::class, 200)->make()->toArray());
    }
}
