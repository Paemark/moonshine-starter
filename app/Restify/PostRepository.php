<?php

declare(strict_types=1);

namespace App\Restify;

use App\Models\Post;
use Binaryk\LaravelRestify\Fields\Field;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use Binaryk\LaravelRestify\Repositories\Repository;

class PostRepository extends Repository
{
    public static string $model = Post::class;

    public static string $title = 'title';

    public static string $uriKey = 'posts';

    public static array $with = ['user', 'category'];

    /** @var bool|array<string, mixed> */
    public static bool|array $public = true;

    /**
     * @return array<int, \Binaryk\LaravelRestify\Fields\Field>
     */
    public function fields(RestifyRequest $request): array
    {
        return [
            Field::make('id')->readonly(),

            Field::make('title')
                ->required()
                ->rules('string', 'max:255'),

            Field::make('slug')
                ->required()
                ->rules('string', 'max:255'),

            Field::make('excerpt'),

            Field::make('content'),

            Field::make('status')
                ->required()
                ->rules('in:draft,pending,published'),

            Field::make('published_at'),

            Field::make('category_id'),

            Field::make('user_id'),
        ];
    }
}
