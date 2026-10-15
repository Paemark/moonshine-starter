<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Category;

use App\Models\Category;
use App\MoonShine\Resources\Category\Pages\CategoryDetailPage;
use App\MoonShine\Resources\Category\Pages\CategoryFormPage;
use App\MoonShine\Resources\Category\Pages\CategoryIndexPage;
use MoonShine\Laravel\Resources\ModelResource;

class CategoryResource extends ModelResource
{
    protected string $model = Category::class;

    protected string $title = 'Categories';

    protected string $uri = 'categories';

    // Label used by BelongsTo / BelongsToMany option lists and async search
    protected string $column = 'name';

    protected bool $withSoftDeletes = true;

    protected bool $withPolicy = true;

    protected function pages(): array
    {
        return [
            CategoryIndexPage::class,
            CategoryFormPage::class,
            CategoryDetailPage::class,
        ];
    }
}
