<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $filleable = ['control_number'];

    /**
     * Enlace polimórfico con la entidad Email
     * 
     * @return App\Email
     */
    public function email()
    {
        return $this->morphMany('App\Email', 'emailable');
    }
}
