<?php

declare(strict_types=1);

namespace App\Restify;

use App\Models\Category;
use Binaryk\LaravelRestify\Fields\ID;
use Binaryk\LaravelRestify\Fields\Text;
use Binaryk\LaravelRestify\Fields\Textarea;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use Binaryk\LaravelRestify\Repositories\Repository;
use Illuminate\Auth\Access\AuthorizationException;

class CategoryRepository extends Repository
{
    public static string $model = Category::class;

    public static string $title = 'name';

    public static string $uriKey = 'categories';

    /** @var bool|array<string, mixed> */
    public static bool|array $public = true;

    public function allowRestify(RestifyRequest $request): bool
    {
        return true;
    }

    public function allowToIndex(RestifyRequest $request): bool
    {
        return true;
    }

    /**
     * @return array<int, \Binaryk\LaravelRestify\Fields\Field>
     */
    public function fields(RestifyRequest $request): array
    {
        return [
            ID::make(),
            Text::make('Name', 'name'),
            Text::make('Slug', 'slug'),
            Textarea::make('Description', 'description'),
        ];
    }

    public function allowToUpdate(
        RestifyRequest $request,
        mixed $payload = null
    ): self {
        if (! $request->user()?->can(
            'update',
            $payload ?? static::$model
        )) {
            throw new AuthorizationException();
        }

        return $this;
    }

    public function allowToDelete(
        RestifyRequest $request,
        mixed $payload = null
    ): self {
        if (! $request->user()?->can(
            'delete',
            $payload ?? static::$model
        )) {
            throw new AuthorizationException();
        }

        return $this;
    }

    public function allowToRestore(
        RestifyRequest $request,
        mixed $payload = null
    ): self {
        if (! $request->user()?->can(
            'restore',
            $payload ?? static::$model
        )) {
            throw new AuthorizationException();
        }

        return $this;
    }

    public function allowToForceDelete(
        RestifyRequest $request,
        mixed $payload = null
    ): self {
        if (! $request->user()?->can(
            'forceDelete',
            $payload ?? static::$model
        )) {
            throw new AuthorizationException();
        }

        return $this;
    }
}
