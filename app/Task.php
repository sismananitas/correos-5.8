<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * Campos rellenables
     * 
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'medium', 'client_name',
    ];

    /**
     * Enlace a su entidad padre User
     * 
     * @return App\User
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Enlace con su entidad padre Email
     * 
     * @return App\Email
     */
    public function email()
    {
        return $this->belongsTo('App\Email');
    }
}
