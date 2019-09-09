<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * Campos rellenables de manera dinámica
     * 
     * @var array
     */
    protected $filleable = ['enrollment'];

    /**
     * Enlace polimorfico a la entidad Email
     * 
     * @return App\Email
     */
    public function email()
    {
        return $this->morphMany('App\Email', 'emailable');
    }
}
