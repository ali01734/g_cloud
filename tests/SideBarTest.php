<?php

use nataalam\Models\User;
use nataalam\TransactionTrait;

class SideBarTest extends TestCase
{
    use TransactionTrait;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSideBarLinks()
    {
        $this->be(User::where('is_admin', true)->first());

        // Check admin index
        $this
            ->visit(route('admin.index'))
            ->see(trans('strings.theComments'))
            ->see(trans('strings.subjects'))
            ->see(trans('strings.theBranches'))
            ->see(trans('strings.theLevels'));

        // Check sidebar
        $this
            ->visit(route('admin.subjects.index'))
            ->see(trans('strings.theComments'))
            ->see(trans('strings.subjects'))
            ->see(trans('strings.theBranches'))
            ->see(trans('strings.theLevels'));
    }
}
