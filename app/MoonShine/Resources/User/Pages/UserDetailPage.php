<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\User\Pages;

use App\MoonShine\Resources\Role\RoleResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;

class UserDetailPage extends DetailPage
{
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Name'),
            Text::make('Email'),
            Switcher::make('Is Active'),
            BelongsToMany::make('Roles', 'roles', resource: RoleResource::class),
            Date::make('Created At', 'created_at'),
            Date::make('Updated At', 'updated_at'),
            Date::make('Deleted At', 'deleted_at'),
        ];
    }
}
