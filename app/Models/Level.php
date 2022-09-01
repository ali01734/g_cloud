<?php

namespace nataalam\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    public $timestamps = false;

    public $fillable = ['name'];

    /**
     * Relationship
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    /**
     * Relationship
     */
    public function branches()
    {
        return $this->belongsToMany(Branch::class);
    }
}
