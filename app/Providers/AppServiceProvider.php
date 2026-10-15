<?php

namespace App\Providers;

use App\MoonShine\Pages\DashboardPage;
use App\MoonShine\Resources\Category\CategoryResource;
use App\MoonShine\Resources\Post\PostResource;
use App\MoonShine\Resources\Role\RoleResource;
use App\MoonShine\Resources\User\UserResource;
use App\Policies\RolePolicy;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
use Laravel\Fortify\Fortify;
use Illuminate\Support\ServiceProvider;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(CoreContract $core): void
    {
        Schema::defaultStringLength(191);

        // Spatie's Role model lives in vendor/, so Laravel's policy
        // auto-discovery cannot find RolePolicy. Register it explicitly.
        Gate::policy(Role::class, RolePolicy::class);

        $core->resources([
            UserResource::class,
            CategoryResource::class,
            PostResource::class,
            RoleResource::class,
        ]);

        $core->pages([
            DashboardPage::class,
        ]);

        Fortify::loginView(fn () => view('auth.login'));
        Fortify::registerView(fn () => view('auth.register'));
        Fortify::requestPasswordResetLinkView(fn () => view('auth.forgot-password'));
        Fortify::resetPasswordView(fn ($request) => view('auth.reset-password', ['request' => $request]));
        Fortify::verifyEmailView(fn () => view('auth.verify-email'));

        RateLimiter::for('login', fn (Request $request) => Limit::perMinute(5)->by(strtolower($request->input(Fortify::username())) . '|' . $request->ip()));
        RateLimiter::for('reset-password', fn (Request $request) => Limit::perMinute(3)->by($request->ip() . '|' . strtolower($request->input('email'))));
        RateLimiter::for('api', fn (Request $request) => Limit::perMinute(60)->by($request->user()?->id ?: $request->ip()));
    }
}