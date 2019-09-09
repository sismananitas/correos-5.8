<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Other extends Model
{
    /**
     * Campos rellenables dinámicamente
     * 
     * @var array
     */
    protected $filleable = [
        'name', 'lastname',
    ];

    /**
     * Enlace con la entidad Email
     * 
     * @return App\Email
     */
    public function email()
    {
        return $this->morphMany('App\Email', 'emailable');
    }
}
