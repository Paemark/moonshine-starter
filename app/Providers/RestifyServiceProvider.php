<?php

namespace App\Providers;

use Binaryk\LaravelRestify\RestifyApplicationServiceProvider;
use Illuminate\Support\Facades\Gate;

class RestifyServiceProvider extends RestifyApplicationServiceProvider
{
    /**
     * Configure who can access Restify.
     */
    protected function gate(): void
    {
        Gate::define('viewRestify', function ($user = null): bool {
            return true;
        });
    }
}
