<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Category\Pages;

use Illuminate\Support\Str;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

class CategoryFormPage extends FormPage
{
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),

                Text::make('Name')
                    ->required()
                    ->hint('Slug auto-generated if empty'),

                Text::make('Slug')->hint('Leave empty to auto-generate'),

                // v4: row height is set via customAttributes, not rows()
                Textarea::make('Description')
                    ->customAttributes(['rows' => 3]),

                Image::make('Thumbnail', 'thumbnails')
                    ->allowedExtensions(['jpg', 'png', 'webp'])
                    ->removable(),
            ]),
        ];
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable', 'string', 'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                'unique:categories,slug,' . $item->getKey(),
            ],
            'description' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function validationMessages(): array
    {
        return [
            'slug.unique' => 'This slug is already in use.',
            'slug.regex' => 'The slug must contain only lowercase letters, numbers, and hyphens.',
        ];
    }

    public function prepareForValidation(): void
    {
        if (blank(request()->input('slug')) && filled(request()->input('name'))) {
            request()->merge(['slug' => Str::slug(request()->input('name'))]);
        }
    }
}
