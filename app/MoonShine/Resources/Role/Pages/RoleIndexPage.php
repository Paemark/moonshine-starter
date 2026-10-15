<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Role\Pages;

use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

class RoleIndexPage extends IndexPage
{
    protected function fields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Name')->sortable(),
            Text::make('Guard Name', 'guard_name')->sortable(),
            Date::make('Created At', 'created_at')->sortable(),
        ];
    }

    protected function filters(): array
    {
        return [
            Text::make('Name'),
        ];
    }
}
