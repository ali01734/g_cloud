<?php

namespace nataalam\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Examples of subjects are maths, physics, etc.
 * @package nataalam
 */
class Subject extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'color'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function exams()
    {
        return $this->hasMany(ExamFile::class);
    }

    public function bacComments()
    {
        return $this->hasMany(Comment::class, 'bac_subject_id');
    }

    public function regionalComments()
    {
        return $this->hasMany(Comment::class, 'regional_subject_id');
    }

    public function bacs()
    {
        return $this->hasMany(BacExamFile::class);
    }

    public function commentsForYear(string $year)
    {
        $method = $year == 'first' ? 'regionalComments' : 'bacComments';
        return $this->{$method}();
    }
}

