<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $filleable = ['name'];
    
    /**
     * Enlace con la entidad User
     * 
     * @return App\User
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
