<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\User\Pages;

use App\MoonShine\Resources\Role\RoleResource;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;

class UserFormPage extends FormPage
{
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),

                Text::make('Name')->required(),

                Email::make('Email')->required(),

                Password::make('Password')
                    ->hint('Leave empty to keep current password'),

                // v4: many-to-many relations persist via BelongsToMany, never via Select
                BelongsToMany::make('Roles', 'roles', resource: RoleResource::class)
                    ->hint('Assign Spatie roles to this user'),

                Switcher::make('Is Active')->default(true),
            ]),
        ];
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $item->getKey()],
            'password' => $item->getKey() ? ['nullable', 'string', 'min:8'] : ['required', 'string', 'min:8'],
            'is_active' => ['required', 'boolean'],
        ];
    }

    public function validationMessages(): array
    {
        return [
            'email.unique' => 'This email address is already registered.',
            'password.min' => 'The password must be at least 8 characters.',
        ];
    }
}
