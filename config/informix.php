<?php
/**
 * Created by PhpStorm.
 * User: llaijiale
 * Date: 2017/8/2
 * Time: 10:21
 */

return [
    'personal' => [
        'driver'    => 'informix',
        'host'      => env('IFX_HOST', 'localhost'),
        'database'  => env('IFX_DATABASE', 'forge'),
        'username'  => env('IFX_USERNAME', 'forge'),
        'password'  => env('IFX_PASSWORD', ''),
        'service'  => env('IFX_SERVICE', '11143'),
        'server'  => env('IFX_SERVER', ''),
        'db_locale'   => 'en_US.819',
        'client_locale' => 'en_US.819',
        'initSqls' => false, 
        'prefix'    => ''
    ],
    'escolares' => [
        'driver'    => 'informix',
        'host'      => env('ESC_HOST', 'localhost'),
        'database'  => env('ESC_DATABASE', 'forge'),
        'username'  => env('ESC_USERNAME', 'forge'),
        'password'  => env('ESC_PASSWORD', ''),
        'service'  => env('ESC_SERVICE', '11143'),
        'server'  => env('ESC_SERVER', ''),
        'db_locale'   => 'en_US.819',
        'client_locale' => 'en_US.819',
        'initSqls' => false, 
        'prefix'    => ''
    ],
];
