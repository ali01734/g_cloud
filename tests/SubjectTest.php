<?php

use nataalam\Models\Subject;
use nataalam\Models\User;
use nataalam\TransactionTrait;

class SubjectTest extends TestCase
{
    use TransactionTrait;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->be(User::where('is_admin', true)->first());
        $this
            ->visit('/admin/subjects')
            ->see(trans('strings.subjectList'))
            ->see(trans('strings.theCourses'))
            ->see(trans('strings.theExams'))
            ->see(trans('strings.bac'));
    }

    public function testShow()
    {
        $subject = Subject::first();
        $this
            ->visit("subjects/$subject->id")
            ->see($subject->name);
    }
}
