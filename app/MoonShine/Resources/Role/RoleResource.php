<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Role;

use App\MoonShine\Resources\Role\Pages\RoleDetailPage;
use App\MoonShine\Resources\Role\Pages\RoleFormPage;
use App\MoonShine\Resources\Role\Pages\RoleIndexPage;
use MoonShine\Laravel\Resources\ModelResource;
use Spatie\Permission\Models\Role;

class RoleResource extends ModelResource
{
    protected string $model = Role::class;

    protected string $title = 'Roles';

    protected string $uri = 'roles';

    // Label used by BelongsTo / BelongsToMany option lists and async search
    protected string $column = 'name';

    protected bool $withPolicy = true;

    protected function pages(): array
    {
        return [
            RoleIndexPage::class,
            RoleFormPage::class,
            RoleDetailPage::class,
        ];
    }
}
