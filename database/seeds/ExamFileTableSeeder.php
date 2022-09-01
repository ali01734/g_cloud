<?php

use Illuminate\Database\Seeder;
use nataalam\Models\Course;
use nataalam\Models\ExamFile;
use nataalam\Models\Subject;

class ExamFileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = Subject::all();

        $this->insertExamFiles($subjects);
        $this->attachCoursesToExams();
        $this->copyDummyFiles();
    }

    private function insertExamFiles($subjects) {
        $exams = factory(ExamFile::class, 100)->make();
        $exams->each(function($exam) use($subjects) {
            $exam->subject_id = $subjects->random()->id;
        });

        DB::table('exam_files')->insert($exams->toArray());
    }

    private function attachCoursesToExams() {
        $exams = DB::table('exam_files')->select('id', 'subject_id')->get();
        $courses = Course::all();

        $relations = [];
        foreach($exams as $exam) {
            $coursesToAttach = $courses->filter(function($c) use($exam) {
                return $c->subject_id === $exam->subject_id;
            });

            $entries = $coursesToAttach
                ->map(function($c) use($exam) {
                    return [
                        'exam_file_id' => $exam->id,
                        'course_id' => $c['id']
                    ];
                })
                ->toArray();

            $relations = array_merge($relations, $entries);
        }

        DB::table('course_exam_file')->insert($relations);
    }

    private function copyDummyFiles() {
        $exams = DB::table('exam_files')->select('id')->get();

        foreach($exams as $exam) {
            File::copy(
                base_path('database/seeds/exam.pdf'),
                storage_path(ExamFile::$examPath . "/$exam->id.pdf")
            );

            File::copy(
                base_path('database/seeds/exam.pdf'),
                storage_path(ExamFile::$correctPath . "/$exam->id.pdf")
            );
        }

    }
}
