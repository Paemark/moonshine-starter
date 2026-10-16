<?php

use Illuminate\Support\Facades\Route;
use App\Restify\PostRepository;
use App\Restify\CategoryRepository;
use App\Restify\UserRepository;
use App\Restify\RoleRepository;

/*
|--------------------------------------------------------------------------
| Laravel Restify API
|--------------------------------------------------------------------------
|
| Default base URL: /api/restify
|
| Register the repositories discovered by Laravel Restify.
|
*/

Route::middleware([
    'api',
])->group(function () {
    /*
     * Restify discovers repositories automatically.
     * The package's configured routes provide the endpoints.
     *
     * Do not manually duplicate the package's internal
     * repository routes here.
     */
});
