<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Post\Pages;

use App\MoonShine\Resources\Category\CategoryResource;
use App\MoonShine\Resources\User\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Select;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

class PostFormPage extends FormPage
{
    protected function fields(): iterable
    {
        return [
            Box::make('Post Details', [
                ID::make(),

                Text::make('Title')->required(),

                Text::make('Slug')->hint('Leave empty to auto-generate'),

                Textarea::make('Excerpt')
                    ->customAttributes(['rows' => 2])
                    ->hint('Short summary for SEO'),

                Textarea::make('Content')
                    ->required()
                    ->customAttributes(['rows' => 15])
                    ->hint('Sanitized automatically'),
            ]),

            Box::make('Publishing', [
                Grid::make([
                    Column::make([
                        Select::make('Status')
                            ->options(['draft' => 'Draft', 'pending' => 'Pending Review', 'published' => 'Published'])
                            ->required()
                            ->default('draft'),
                    ]),
                    Column::make([
                        Date::make('Published At', 'published_at')->hint('Leave empty for drafts'),
                    ]),
                ]),

                Grid::make([
                    Column::make([
                        BelongsTo::make('Category', resource: CategoryResource::class)
                            ->required()
                            ->searchable(),
                    ]),
                    // Author is assigned server-side in prepareForValidation()
                    Column::make([
                        BelongsTo::make('Author', 'user', resource: UserResource::class)
                            ->required()
                            ->searchable(),
                    ]),
                ]),

                Image::make('Featured Image', 'featured_images')
                    ->allowedExtensions(['jpg', 'png', 'webp'])
                    ->removable(),
            ]),
        ];
    }

    protected function rules(DataWrapperContract $item): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable', 'string', 'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                'unique:posts,slug,' . $item->getKey(),
            ],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'status' => ['required', 'in:draft,pending,published'],
            'published_at' => ['nullable', 'date'],
            'category_id' => ['required', 'exists:categories,id'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }

    public function validationMessages(): array
    {
        return [
            'slug.unique' => 'This slug is already in use.',
            'slug.regex' => 'The slug must contain only lowercase letters, numbers, and hyphens.',
            'status.in' => 'Invalid status selected.',
            'category_id.exists' => 'The selected category does not exist.',
        ];
    }

    public function prepareForValidation(): void
    {
        if (blank(request()->input('slug')) && filled(request()->input('title'))) {
            request()->merge(['slug' => Str::slug(request()->input('title'))]);
        }

        if (blank(request()->input('user_id'))) {
            request()->merge(['user_id' => Auth::id()]);
        }
    }
}
