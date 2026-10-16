<?php

declare(strict_types=1);

namespace App\Restify;

use Binaryk\LaravelRestify\Fields\ID;
use Binaryk\LaravelRestify\Fields\Text;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use Binaryk\LaravelRestify\Repositories\Repository;
use Illuminate\Auth\Access\AuthorizationException;
use Spatie\Permission\Models\Role;

class RoleRepository extends Repository
{
    public static string $model = Role::class;

    public static string $title = 'name';

    public static string $uriKey = 'roles';

    public function allowRestify(RestifyRequest $request): bool
    {
        return $request->user()?->hasRole('admin') ?? false;
    }

    public function allowToIndex(RestifyRequest $request): bool
    {
        return $request->user()?->hasRole('admin') ?? false;
    }

    /**
     * @return array<int, \Binaryk\LaravelRestify\Fields\Field>
     */
    public function fields(RestifyRequest $request): array
    {
        return [
            ID::make(),
            Text::make('Name', 'name'),
            Text::make('Guard Name', 'guard_name'),
        ];
    }

    public function allowToUpdate(
        RestifyRequest $request,
        mixed $payload = null
    ): self {
        if (! $request->user()?->hasRole('admin')) {
            throw new AuthorizationException(
                'Only administrators can update roles.'
            );
        }

        return $this;
    }

    public function allowToDelete(
        RestifyRequest $request,
        mixed $payload = null
    ): self {
        throw new AuthorizationException(
            'Roles cannot be deleted through the API.'
        );
    }
}
