<?php

namespace App\Providers;

use App\MoonShine\Pages\DashboardPage;
use App\MoonShine\Resources\Category\CategoryResource;
use App\MoonShine\Resources\Post\PostResource;
use App\MoonShine\Resources\Role\RoleResource;
use App\MoonShine\Resources\User\UserResource;
use App\Policies\PostPolicy;
use App\Policies\RolePolicy;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use MoonShine\Contracts\Core\DependencyInjection\CoreContract;
use Spatie\Permission\Models\Role;
use App\Models\Post;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(CoreContract $core): void
    {
        Schema::defaultStringLength(191);

        Gate::policy(Role::class, RolePolicy::class);
        Gate::policy(Post::class, PostPolicy::class);

        $core->resources([
            UserResource::class,
            CategoryResource::class,
            PostResource::class,
            RoleResource::class,
        ]);

        $core->pages([
            DashboardPage::class,
        ]);

        Fortify::loginView(
            fn () => view('auth.login')
        );

        Fortify::registerView(
            fn () => view('auth.register')
        );

        Fortify::requestPasswordResetLinkView(
            fn () => view('auth.forgot-password')
        );

        Fortify::resetPasswordView(
            fn (Request $request) => view(
                'auth.reset-password',
                ['request' => $request]
            )
        );

        Fortify::verifyEmailView(
            fn () => view('auth.verify-email')
        );

        RateLimiter::for('login', function (Request $request) {
            $username = strtolower(
                (string) $request->input(Fortify::username())
            );

            return Limit::perMinute(5)
                ->by($username . '|' . $request->ip());
        });

        RateLimiter::for('reset-password', function (Request $request) {
            $email = strtolower(
                (string) $request->input('email')
            );

            return Limit::perMinute(3)
                ->by($request->ip() . '|' . $email);
        });

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)
                ->by(
                    $request->user()?->getAuthIdentifier()
                    ?? $request->ip()
                );
        });
    }
}
