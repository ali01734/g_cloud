<?php

namespace Test;

use nataalam\BeAdminTrait;
use nataalam\Models\BacExamFile;
use nataalam\Models\Branch;
use nataalam\Models\Subject;

use nataalam\TransactionTrait;
use TestCase;

class BacExamFileTest extends TestCase
{
    use TransactionTrait;
    use BeAdminTrait;

    public function testCreateForm()
    {
        $this->beAdmin();
        $this
            ->visit(route('admin.bacs.index', Subject::first()))
            ->seeElement('.fa.fa-trash-o')
            ->see(trans('strings.add'))
            ->click(trans('strings.add'))
            ->see(trans('strings.ok'))
            ->see(trans('strings.cancel'));
    }

    public function testClientIndex()
    {

        $subject = Subject::first();
        $this
            ->visit(route('bacs.index', $subject))
            ->see(trans('strings.bac_index_title_'))
            ->seeElement('table')
            ->within('table tr:first-child', function() {
                $this->see(trans('strings.academicYear'));
            });

        foreach(Branch::inBacYear('second') as $branch) {
            $this->see($branch->name);
        }

    }

    public function testEdit()
    {
        $this
            ->beAdmin()
            ->visit(route('admin.bacs.index', Subject::first()))
            ->within('table.table tr:nth-child(2)', function() {
               $this
                   ->click('edit-link')
                   ->see(trans('strings.ok'))
                   ->see(trans('strings.cancel'));
            });
    }

    public function testCreate()
    {
        $this
            ->beAdmin()
            ->visit(route('admin.bacs.index', Subject::first()))
            ->seeElement('.box .table')
            ->click('create-button')
            ->see(trans('strings.ok'))
            ->see(trans('strings.cancel'));
    }

    public function testShowsOnlyBacBranhesOnBacPageSelect()
    {
        $this
            ->visit(route('bacs.index', Subject::first()))
            ->countElements(
                'option.branch-option',
                Branch::inBacYear('second')->count()
            );
    }

}