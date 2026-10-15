<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Role\Pages;

use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;

class RoleDetailPage extends DetailPage
{
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Name'),
            Text::make('Guard Name', 'guard_name'),
            Date::make('Created At', 'created_at'),
            Date::make('Updated At', 'updated_at'),
        ];
    }
}
