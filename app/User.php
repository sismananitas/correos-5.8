<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Enlace uno a muchos con la entidad Task
     * 
     * @return array App\Task
     */
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    /**
     * Enlace de muchos a muchos con la entidad Role
     * 
     * @return array App\Role
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
}
