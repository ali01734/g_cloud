<?php

use nataalam\Models\Course;
use nataalam\TransactionTrait;

class ExamFileTest extends TestCase
{
    use TransactionTrait;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExamsClientIndex()
    {
        $course = Course::whereHas('exams', function($q) {})->first();

        $this
            ->visit(route('exams.index', $course->id))
            ->seeElement('table')
            ->see($course->name)
            ->see($course->subject->name)
            ->seeElement('.fa.fa-file-pdf-o');
    }
}
