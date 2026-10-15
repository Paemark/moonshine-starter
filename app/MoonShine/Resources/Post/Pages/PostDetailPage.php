<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Post\Pages;

use App\MoonShine\Resources\Category\CategoryResource;
use App\MoonShine\Resources\User\UserResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

class PostDetailPage extends DetailPage
{
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Title'),
            Text::make('Slug'),
            Textarea::make('Excerpt'),
            Textarea::make('Content')->unescape(),
            Select::make('Status')->options(['draft' => 'Draft', 'pending' => 'Pending Review', 'published' => 'Published']),
            Date::make('Published At', 'published_at'),
            BelongsTo::make('Category', resource: CategoryResource::class),
            BelongsTo::make('Author', resource: UserResource::class),
            Image::make('Featured Image', 'featured_images'),
            Date::make('Created At', 'created_at'),
            Date::make('Updated At', 'updated_at'),
            Date::make('Deleted At', 'deleted_at'),
        ];
    }
}
