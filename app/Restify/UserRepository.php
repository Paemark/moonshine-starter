<?php

declare(strict_types=1);

namespace App\Restify;

use App\Models\User;
use Binaryk\LaravelRestify\Fields\BelongsToMany;
use Binaryk\LaravelRestify\Fields\Boolean;
use Binaryk\LaravelRestify\Fields\ID;
use Binaryk\LaravelRestify\Fields\Text;
use Binaryk\LaravelRestify\Http\Requests\RestifyRequest;
use Binaryk\LaravelRestify\Repositories\Repository;
use Illuminate\Auth\Access\AuthorizationException;

class UserRepository extends Repository
{
    public static string $model = User::class;

    public static string $title = 'name';

    public static string $uriKey = 'users';

    public function allowRestify(RestifyRequest $request): bool
    {
        return $request->user() !== null;
    }

    public function allowToIndex(RestifyRequest $request): bool
    {
        return $request->user()?->can('viewAny', User::class) ?? false;
    }

    public function fields(RestifyRequest $request): array
    {
        return [
            ID::make(),

            Text::make('Name', 'name')
                ->rules('required', 'string', 'max:255'),

            Text::make('Email', 'email')
                ->rules('required', 'email', 'max:255'),

            Boolean::make('Is Active', 'is_active')
                ->rules('required', 'boolean'),

            BelongsToMany::make(
                'Roles',
                'roles',
                RoleRepository::class
            )->readonly(),
        ];
    }

    public function allowToUpdate(
        RestifyRequest $request,
        $payload = null
    ): self {
        if (! $request->user()?->can(
            'update',
            $payload ?? $this->model
        )) {
            throw new AuthorizationException();
        }

        return $this;
    }

    public function allowToDelete(
        RestifyRequest $request,
        $payload = null
    ): self {
        if (! $request->user()?->can(
            'delete',
            $payload ?? $this->model
        )) {
            throw new AuthorizationException();
        }

        return $this;
    }

    public function allowToRestore(
        RestifyRequest $request,
        $payload = null
    ): self {
        if (! $request->user()?->can(
            'restore',
            $payload ?? $this->model
        )) {
            throw new AuthorizationException();
        }

        return $this;
    }

    public function allowToForceDelete(
        RestifyRequest $request,
        $payload = null
    ): self {
        if (! $request->user()?->can(
            'forceDelete',
            $payload ?? $this->model
        )) {
            throw new AuthorizationException();
        }

        return $this;
    }
}
