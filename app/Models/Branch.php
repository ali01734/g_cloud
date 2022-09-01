<?php

namespace nataalam\Models;


use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name',
        'first_year',
        'second_year'
    ];

    /**
     * Relationship
     */
    public function levels()
    {
        return $this->belongsToMany(Level::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function bacExamFiles()
    {
        return $this->belongsToMany(BacExamFile::class);
    }

    public function scopeInBac($query, $year = 'second') {
        $query->whereHas('levels', function($q) use($year) {
            $q->where('name', '=', config("app.{$year}_bac_level_name"));
        });
    }

    public function examFiles() {
        return $this->belongsToMany(ExamFile::class);
    }

    public static function inBacYear(string $year) : \Traversable{
        return Branch::where($year . '_year', true)->get();
    }
}


