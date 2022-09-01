<?php

namespace nataalam\Models;

use Illuminate\Database\Eloquent\Model;
use nataalam\Models\Interfaces\CanContainImages;
use nataalam\Models\Traits\TmpImagesTrait;

/**
 * @property string name
 * @property string difficulty
 * @property string text
 */
class Exercise extends Model implements CanContainImages
{
    private static $ckEditorFields = ['text', 'solution'];
    private static $publicImgFolder = '/storage/exercises/';

    protected $fillable = [
        'name',
        'text',
        'difficulty',
        'solution',
        'youtube_id',
    ];

    use TmpImagesTrait;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function imagesStorage($photo = null)
    {
        return storage_path(
            join_paths("app/public/exercises/$this->id", $photo)
        );
    }

}

