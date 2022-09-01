<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use nataalam\Models\BacExamFile;
use nataalam\Models\Branch;
use nataalam\Models\City;
use nataalam\Models\Comment;
use nataalam\Models\Course;
use nataalam\Models\ExamFile;
use nataalam\Models\Exercise;
use nataalam\Models\Lesson;
use nataalam\Models\Level;
use nataalam\Models\Subject;
use nataalam\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        \Artisan::call('nataalam:create_storage_dirs');

        $modelClasses = [
            City::class,
            Branch::class,
            User::class,
            Subject::class,
            Level::class,
            Course::class,
            Lesson::class,
            Exercise::class,
            Branch::class,
            Comment::class,
            Comment::class,
            ExamFile::class,
            BacExamFile::class,
        ];

        $seeders = [
            InstallSeeder::class,
            CitiesTableSeeeder::class,
            SubjectTableSeeder::class,
            LevelTableSeeder::class,
            BranchesTableSeeder::class,
            CourseTableSeeder::class,
            LessonTableSeeder::class,
            ExercisesTableSeeder::class,
            UserTableSeeder::class,
            CommentsTableSeeder::class,
            ExamFileTableSeeder::class,
            BacExamFileSeeder::class,
        ];

        foreach ($modelClasses as $class) {
            $tableName = $this->tableName($class);
            echo "Deleting table $tableName" . PHP_EOL;
            DB::table($tableName)->delete();
        }

        foreach ($seeders as $seeder) {
            self::profile(function() use($seeder) {
                $this->call($seeder);
            });
        }

        Model::reguard();
    }

    public static function profile($function, $params = []) {
        $before = microtime(true);
        call_user_func($function, $params);
        $time = microtime(true) - $before;
        echo number_format($time, 2, '.', '')  . 's' . PHP_EOL;
    }

    private function tableName($classname) {
        return (new $classname())->getTable();
    }
}
