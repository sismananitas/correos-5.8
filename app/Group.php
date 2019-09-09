<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $filleable = ['name'];
    
    /**
     * Enlace muchos a muchos con la entidad Email
     * 
     * @return array App\Email
     */
    public function emails()
    {
        return $this->belongsTo('App\Email');
    }
}
