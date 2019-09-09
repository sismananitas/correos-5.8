<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    protected $filleable = [
        'name', 'lastname', 'dependency',
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
