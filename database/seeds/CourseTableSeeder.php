<?php

use Illuminate\Database\Seeder;
use nataalam\Models\Course;
use nataalam\Models\Level;
use nataalam\Models\Subject;

class CourseTableSeeder extends Seeder
{

    private $console;

    public function __construct()
    {
        $this->console = app('nataalam.debug.console');
    }

    public function run()
    {
        $levels = Level::with('branches')->get();
        $allCourses = [];

        foreach (Subject::all() as $subject)
            $allCourses = array_merge(
                $allCourses,
                factory(Course::class, 50)
                    ->make()
                    ->each(set_fk('subject_id', $subject))
                    ->each(set_fk('level_id', $levels->random()))
                    ->toArray()
            );

        Course::insert($allCourses);

        $branchCourse = [];
        foreach (Subject::all() as $subject) {
            $subjectCourses = $subject->courses()->with('level.branches')->get();

            foreach ($subjectCourses as $course) {
                $branchCourse = array_merge(
                    $branchCourse,
                    $course->level->branches
                    ->map(function($b) use($course) {
                        return [
                            'branch_id' => $b->id,
                            'course_id' => $course->id,
                        ];
                    })
                    ->toArray()
                );
            }
        }

        DB::table('branch_course')->insert($branchCourse);

    }
}