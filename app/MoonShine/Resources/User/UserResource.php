<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\User;

use App\Models\User;
use App\MoonShine\Resources\User\Pages\UserDetailPage;
use App\MoonShine\Resources\User\Pages\UserFormPage;
use App\MoonShine\Resources\User\Pages\UserIndexPage;
use MoonShine\Laravel\Resources\ModelResource;

class UserResource extends ModelResource
{
    protected string $model = User::class;

    protected string $title = 'Users';

    protected string $uri = 'users';

    // Label used by BelongsTo / BelongsToMany option lists and async search
    protected string $column = 'name';

    protected bool $withSoftDeletes = true;

    protected bool $withPolicy = true;

    protected function pages(): array
    {
        return [
            UserIndexPage::class,
            UserFormPage::class,
            UserDetailPage::class,
        ];
    }
}
