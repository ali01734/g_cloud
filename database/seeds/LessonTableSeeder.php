<?php

use Illuminate\Database\Seeder;
use nataalam\Models\Course;
use nataalam\Models\Lesson;
use nataalam\Models\Level;

class LessonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lessons = [];
        foreach (DB::table('courses')->select('id')->get() as $course)
            $lessons = array_merge(
                $lessons,
                factory(Lesson::class, 20)
                    ->make()
                    ->each(set_fk('course_id', $course))
                    ->toArray()
            );

        Lesson::insert($lessons);
    }

}
