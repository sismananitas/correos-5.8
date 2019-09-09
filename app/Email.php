<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $fillable = [
        'login', 'password', 'delivered_to', 'status',
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
     * Enlace muchos a muchos con la entidad Group
     * 
     * @return array App\Group
     */
    public function groups()
    {
        return $this->belongsTo('App\Group');
    }
    
    /**
     * Enlace polimórfico hacia cualquier entidad que pueda registrar un correo
     * 
     * @return App\Emailable
     */
    public function emailable()
    {
        return $this->morphTo();
    }
}
