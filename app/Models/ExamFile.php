<?php

namespace nataalam\Models;

use File;
use Illuminate\Database\Eloquent\Model;

class ExamFile extends Model
{
    static public $examPath = 'app/public/exams/exams';
    static public $correctPath = 'app/public/exams/corrections';

    static public $examPath2 = 'public/exams/exams';
    static public $correctPath2 = 'public/exams/corrections';

    protected $fillable = ['description'];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function hasCorrection()
    {
        return \Storage::exists(
            self::$correctPath2 . "/$this->id.pdf"
        );
    }

    public function branches() {
        return $this->belongsToMany(Branch::class);
    }

    public function scopeInBranch($query, $branch) {
        if ($branch)
            $query->whereHas('branches', withId($branch));
    }
}
