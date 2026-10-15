<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Post;

use App\Models\Post;
use App\MoonShine\Resources\Post\Pages\PostDetailPage;
use App\MoonShine\Resources\Post\Pages\PostFormPage;
use App\MoonShine\Resources\Post\Pages\PostIndexPage;
use MoonShine\Laravel\Resources\ModelResource;

class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Posts';

    protected string $uri = 'posts';

    // Label used by BelongsTo / BelongsToMany option lists and async search
    protected string $column = 'title';

    protected bool $withSoftDeletes = true;

    protected bool $withPolicy = true;

    protected function pages(): array
    {
        return [
            PostIndexPage::class,
            PostFormPage::class,
            PostDetailPage::class,
        ];
    }
}
