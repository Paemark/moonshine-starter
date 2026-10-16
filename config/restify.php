<?php

use Binaryk\LaravelRestify\Http\Middleware\AuthorizeRestify;
use Binaryk\LaravelRestify\Http\Middleware\DispatchRestifyStartingEvent;

return [

    'base' => '/api/restify',

    'middleware' => [
        'api',
        \Binaryk\LaravelRestify\Http\Middleware\DispatchRestifyStartingEvent::class,
        \Binaryk\LaravelRestify\Http\Middleware\AuthorizeRestify::class,
    ],


    'auth' => [
        'user_model' => App\Models\User::class,
    ],
];
