<?php

namespace nataalam\Models;

use Illuminate\Database\Eloquent\Model;
use nataalam\Models\Traits\HasFileAttrTrait;

class BacExamFile extends Model
{
    use HasFileAttrTrait;

    public static $correctDir = 'app/public/bacs/corrections';
    public static $bacDir = 'app/public/bacs/exams';

    public $fillable = [
        'year',
        'type',
        'region'
    ];

    protected $appends = [
        'has_exam',
        'has_correction',
        'correction_url',
        'exam_url',
        'ar_region',
        'ar_type'
    ];

    public static $defaultTypes = [
        'national',
        'rattrapage'
    ];

    public static $types = [
        'regional',
        'national',
        'rattrapage',
        'year6',
        'year9',
    ];

    public static $regionalTypes = [
        'regional',
        'year6',
        'year9',
    ];

    public static $years = [
        'first',
        'second',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class);
    }

    public function getUrl()
    {
        $path = self::$bacDir . "/$this->id.pdf";
        return '/storage' . preg_replace('#app/public#', '', $path);
    }

    public function getCorrectionUrl()
    {
        $path = self::$correctDir . "/$this->id.pdf";
        return '/storage' . preg_replace('#app/public#', '', $path);
    }

    public function getArTypeAttribute()
    {
        return trans("strings.$this->type");
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeIsRegional($query, $negate = false)
    {
        return $query->where('type', $negate ? '=' : '<>', 'regional');
    }

    public function scopeForBranch($query, $branch = null)
    {
        if (!$branch) return;

        if (is_integer($branch) || is_string($branch))
            $query->whereHas('branches', withId($branch));
        else if ($branch instanceof Branch)
            $query->whereHas('branches', withIdOf($branch));
    }

    public function getHasExamAttribute()
    {
        return $this->hasExam();
    }

    public function getCorrectionUrlAttribute()
    {
        return $this->getCorrectionUrl();
    }

    public function getExamUrlAttribute()
    {
        return $this->getUrl();
    }

    public function getArRegionAttribute()
    {
        return trans('strings.region' . $this->region);
    }

    public function getHasCorrectionAttribute()
    {
        return $this->hasCorrection();
    }

    public function hasExam()
    {
        return $this->hasFileAttribute(self::$bacDir);
    }

    public function hasCorrection()
    {
        return $this->hasFileAttribute(self::$correctDir);
    }

    public function scopeHasType($query, $type = null)
    {
        if (!$type)
            $query
                ->where('type', '=', 'national')
                ->orWhere('type', '=', 'rattrapage');
        else
            $query->where('type', '=', $type);
    }

    /**
     * @param Subject $subject
     * @param $type
     * @return array
     */
    public static function regionsWithExams(Subject $subject, $type)
    {
        $regionsQuery = \DB::table('bac_exam_files')
            ->select(\DB::raw('DISTINCT region'))
            ->where('subject_id', '=', $subject->id)
            ->where('region', '<>', null);

        if (!$type)
            $regionsQuery->where('type', 'in', BacExamFile::$defaultTypes);
        else
            $regionsQuery->where('type', '=', $type);

        $regions = array_map(function ($r) {
            return $r->region;
        }, $regionsQuery->get());
        return $regions;
    }

    /**
     * @param Subject $subject
     * @param $type
     * @param $branch
     * @param $region
     * @return mixed
     */
    public static function filter(Subject $subject, $type, $branch, $region)
    {
        $bacQuery = BacExamFile
            ::whereHas('subject', withIdOf($subject))
            ->hasType($type)
            ->forBranch($branch)
            ->orderBy('year', 'DESC');

        if ($region)
            $bacQuery->where('region', '=', $region);

        return $bacQuery->get();
    }
}
