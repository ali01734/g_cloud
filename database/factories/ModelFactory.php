<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use Faker\Generator;

use nataalam\Models\BacExamFile;
use nataalam\Models\Branch;
use nataalam\Models\City;
use nataalam\Models\Comment;
use nataalam\Models\ExamFile;
use nataalam\Models\Exercise;
use nataalam\Models\Lesson;
use nataalam\Models\Subject;
use nataalam\Models\Course;
use nataalam\Models\Level;
use nataalam\Models\User;

define('YOUTUBE_ID', 'njCDZWTI-xg');

$factory->define(User::class, function (Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt("password"),
        'remember_token' => str_random(10),
        'school' => $faker->sentence(3),
    ];
});


$factory->define(Subject::class, function(Generator $faker) {
    return [
        'name' => $faker->randomElement([
            'Math',
            'Physics',
            'Chemistry',
            'Biology',
            'Programming',
            'English',
            'Philosophy'
        ]),
        'description' => $faker->sentence(3),
        'icon' => '/images/subjects/' . rand(0, 5) . '.svg',
        'color' => $faker->hexColor
    ];
});


$factory->define(Exercise::class, function(Generator $faker) {
    return [
        'name' => 'Exercise ' . $faker->word(),
        'difficulty' => $faker->randomElement([
            'easy',
            'medium',
            'hard'
        ]),
        'text' => $faker->text(200),
        'youtube_id' => YOUTUBE_ID,
        'solution' => $faker->text(200),
    ];
});


$factory->define(Course::class, function(Generator $faker) {
    return [
        'name' => 'Course ' . $faker->word(),
        'description' => $faker->text(150)
    ];
});


$factory->define(Level::class, function(Generator $faker) {
    return [
        'name' => 'Level ' . $faker->word(),
        'description' => $faker->text(150),
        'displayed' => true
    ];
});


$factory->define(Lesson::class, function(Generator $faker) {
    return [
        'name' => 'Lesson ' . $faker->word(),
        'text' => $faker->text(200),
        'youtube_id' => YOUTUBE_ID,
    ];
});


$factory->define(Branch::class, function(Generator $faker) {
    return [
        'name' => 'Branch ' . $faker->word(),
        'first_year' => $faker->boolean(),
        'second_year' => $faker->boolean(),
    ];
});

$factory->define(User::class, function(Generator $faker) {
    return [
        'firstName' => $faker->firstName(),
        'lastName' => $faker->lastName(),
        'email' => $faker->email(),
        'password' => bcrypt('password'),
        'username' => $faker->userName(),
        'verified' => true,
    ];
});

$factory->define(Comment::class, function(Generator $faker) {
    return [
        'text' => $faker->paragraph(),
    ];
});

$factory->define(City::class, function(Generator $faker) {
    return [
        'name' => $faker->city(),
    ];
});

$factory->define(BacExamFile::class, function(Generator $faker) {
    $type = $faker->randomElement(BacExamFile::$types);
    $region = in_array($type, BacExamFile::$regionalTypes) ?
        $faker->randomElement(range(1, 12)) : null;

    return [
        'type' => $type,
        'year' => $faker->randomElement(range(1990, date('Y'))),
        'region' => $region,
    ];
});


$factory->define(ExamFile::class, function(Generator $faker) {
   return [
       'description' => $faker->sentence()
   ];
});

