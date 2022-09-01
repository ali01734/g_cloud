<?php

namespace nataalam\Models;

use Illuminate\Database\Eloquent\Model;
use nataalam\Models\Interfaces\CanContainImages;
use nataalam\Models\Traits\TmpImagesTrait;

class Lesson extends Model implements CanContainImages
{
    private static $ckEditorFields = ['text'];
    private static $publicImgFolder = '/storage/lessons/';

    public $fillable = [
        'order',
        'text',
        'name',
        'youtube_id',
    ];

    use TmpImagesTrait;

    /**
     * Relationship
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Relationship
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function imagesStorage($photo = null)
    {
        return storage_path(join_paths("app/public/lessons/$this->id", $photo));
    }
}
