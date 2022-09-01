<?php

namespace nataalam\Models;

use Auth;
use File;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * @property mixed level_id
 * @property mixed city_id
 * @property mixed branch_id
 */
class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract

{
    public static $photoPath = 'app/public/users/photos';
    public static $defaultPhotoUrl = '/images/default-photo.svg';

    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    protected $appends = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'firstName',
        'lastName',
        'username',
        'school',
        'verification_code',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getNameAttribute()
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return "remember_token";
    }

    /**
     * Determine if the entity has a given ability.
     *
     * @param  string $ability
     * @param  array|mixed $arguments
     * @return bool
     */
    public function can($ability, $arguments = [])
    {
        // TODO: Implement can() method.
    }

    /**
     * Get the e-mail address where password reset links are sent.
     *
     * @return string
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function reportedComments()
    {
        return $this->belongsToMany(Comment::class, 'user_reported_comment');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function photoPath()
    {
        return storage_path(User::$photoPath . "/$this->id.jpg");
    }

    public function photoUrlOrDefault()
    {
        return $this->hasPhoto() ? $this->photoUrl() : self::$defaultPhotoUrl;
    }

    public function photoUrl()
    {
        return '/storage/'
        . preg_replace('#^app/public/#', '', User::$photoPath)
        . "/$this->id.jpg";
    }

    public function hasPhoto()
    {
        return File::exists($this->photoPath());
    }

    public function isCurrent()
    {
        return Auth::user() && Auth::user()->id == $this->id;
    }
}

