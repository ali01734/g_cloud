<?php

use Illuminate\Database\Seeder;
use nataalam\Models\Course;
use nataalam\Models\Exercise;

class ExercisesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $exercises = [];
        foreach (DB::table('courses')->select('id')->get() as $course) {
            $exercises = array_merge($exercises, factory(Exercise::class, 10)
                ->make()
                ->each(set_fk('course_id', $course))
                ->toArray()
            );
        }

        DB::table('exercises')->insert($exercises);
    }
}
