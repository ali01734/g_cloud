<?php

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use nataalam\Models\BacExamFile;
use nataalam\Models\Branch;
use nataalam\Models\Subject;

class BacExamFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bacBranches = Branch::inBac()->get();
        foreach(Subject::all() as $subject) {
            $bacs = $subjectBacs = factory(BacExamFile::class, 20)->make();
            $subject->bacs()->saveMany($bacs);
        }

        echo 'Copying files : ';
        DatabaseSeeder::profile(function() use($bacBranches) {
            foreach (BacExamFile::all() as $bacFile) {
                $this->copyBacFile($bacFile);
                $this->maybeCopyCorrection($bacFile);
                $bacFile->branches()->saveMany($bacBranches->random(3));
            }
        });

    }

    private function copyBacFile($bacExamFile) {
        $dummyFile = base_path('database/seeds/exam.pdf');
        File::copy(
            $dummyFile,
            join_paths(
                storage_path(BacExamFile::$bacDir), "$bacExamFile->id.pdf"
            )
        );
    }

    private function maybeCopyCorrection($bac) {
        $dummyFile = base_path('database/seeds/exam.pdf');
        if (rand(0, 2))
            File::copy(
                $dummyFile,
                join_paths(
                    storage_path(BacExamFile::$correctDir), "$bac->id.pdf"
                )
            );
    }

}
