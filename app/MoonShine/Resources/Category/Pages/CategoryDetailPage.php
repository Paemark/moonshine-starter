<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Category\Pages;

use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

class CategoryDetailPage extends DetailPage
{
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Name'),
            Text::make('Slug'),
            Textarea::make('Description'),
            Image::make('Thumbnail', 'thumbnails'),
            Date::make('Created At', 'created_at'),
            Date::make('Updated At', 'updated_at'),
            Date::make('Deleted At', 'deleted_at'),
        ];
    }
}
