<?php

namespace nataalam\Models;

use File;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'text'
    ];

    static public $picDir = 'app/public/users/photos';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function bacSubject()
    {
        return $this->belongsTo(Subject::class, 'bac_subject_id');
    }

    public function regionalSubject()
    {
        return $this->belongsTo(Subject::class, 'regional_subject_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'replyTo', 'id');
    }

    public function reporters()
    {
        return $this->belongsToMany(User::class, 'user_reported_comment');
    }

    public function scopeNotReply($query)
    {
        $query
            ->whereNull('replyTo')
            ->orderBy('created_at', 'DESC')
            ->with('author')
            ->with('replies');
    }
}
