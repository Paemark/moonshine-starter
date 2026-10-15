<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Post\Pages;

use App\MoonShine\Resources\Category\CategoryResource;
use App\MoonShine\Resources\User\UserResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;

class PostIndexPage extends IndexPage
{
    protected function fields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Title')->sortable(),
            Text::make('Slug')->sortable(),
            Select::make('Status')
                ->options(['draft' => 'Draft', 'pending' => 'Pending Review', 'published' => 'Published'])
                ->sortable(),
            BelongsTo::make('Category', resource: CategoryResource::class),
            BelongsTo::make('Author', resource: UserResource::class),
            Date::make('Created At', 'created_at')->sortable(),
            Date::make('Deleted At', 'deleted_at'),
        ];
    }

    protected function filters(): array
    {
        return [
            Text::make('Title'),
            Select::make('Status')->options(['draft' => 'Draft', 'pending' => 'Pending Review', 'published' => 'Published']),
            BelongsTo::make('Category', resource: CategoryResource::class)->searchable(),
            BelongsTo::make('Author', resource: UserResource::class)->searchable(),
        ];
    }
}
