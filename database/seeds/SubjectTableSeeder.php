<?php

use Illuminate\Database\Seeder;
use nataalam\Models\Subject;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Subject::class, 9)->create();
    }
}
