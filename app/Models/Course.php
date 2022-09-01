<?php

namespace nataalam\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Course
 * A course like trigonometry, limits etc
 *
 * @package nataalam
 */
class Course extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }

    public function exercisesByDifficulty($difficulty)
    {
        return $this
            ->exercises()
            ->where('difficulty', $difficulty)
            ->orderBy('id')
            ->get();
    }

    public function exams()
    {
        return $this->belongsToMany(ExamFile::class);
    }

}
