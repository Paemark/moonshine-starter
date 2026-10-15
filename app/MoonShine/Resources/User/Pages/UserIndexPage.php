<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\User\Pages;

use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;

class UserIndexPage extends IndexPage
{
    protected function fields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Name')->sortable(),
            Text::make('Email')->sortable(),
            Switcher::make('Is Active')->sortable(),
            Date::make('Created At', 'created_at')->sortable(),
            Date::make('Updated At', 'updated_at')->sortable(),
            Date::make('Deleted At', 'deleted_at'),
        ];
    }

    protected function filters(): array
    {
        return [
            Text::make('Name'),
            Text::make('Email'),
        ];
    }
}
