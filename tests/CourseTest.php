<?php

namespace Tests;

use nataalam\Models\Course;
use nataalam\TransactionTrait;
use Symfony\Component\HttpFoundation\Response;
use TestCase;

class CourseTest extends TestCase
{
    use TransactionTrait;

    public function testExercisesPageWorking()
    {
        $course = Course::whereHas('exercises', function() {})->first();
        $this
            ->visit(route('exercises.index', $course->id))
            ->seeStatusCode(Response::HTTP_OK)
            ->seeElement('.exercise-sidebar')
            ->seeElement('.sidebar-item');
    }

    public function testLessonsPageWorking()
    {
        $course = Course::whereHas('lessons', function() {})->first();
        $this
            ->visit(route('lessons.index', $course))
            ->seeStatusCode(Response::HTTP_OK)
            ->seeElement('.exercise-sidebar')
            ->countElements(
                '.sidebar-item',
                $course->lessons()->count()
            );
    }

    public function testExamsPageWorking()
    {
        $course = Course::whereHas('exams', function() {})->first();
        $this
            ->visit(route('exams.index', $course))
            ->seeStatusCode(Response::HTTP_OK)
            ->countElements(
                'tr',
                min($course->exams()->count(), 10)  + 1
            );
    }

}