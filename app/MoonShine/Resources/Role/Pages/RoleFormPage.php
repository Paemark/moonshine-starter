<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Role\Pages;

use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;

class RoleFormPage extends FormPage
{
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),

                Text::make('Name')
                    ->required()
                    ->hint('e.g. editor, contributor'),

                Select::make('Guard Name', 'guard_name')
                    ->options(['web' => 'Web'])
                    ->required()
                    ->default('web'),
            ]),
        ];
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:roles,name,' . $item->getKey()],
            'guard_name' => ['required', 'string', 'in:web'],
        ];
    }

    public function validationMessages(): array
    {
        return [
            'name.unique' => 'A role with this name already exists.',
        ];
    }

    public function prepareForValidation(): void
    {
        if (blank(request()->input('guard_name'))) {
            request()->merge(['guard_name' => 'web']);
        }
    }
}
