<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use App\MoonShine\Pages\DashboardPage;
use App\MoonShine\Resources\Category\CategoryResource;
use App\MoonShine\Resources\Post\PostResource;
use App\MoonShine\Resources\Role\RoleResource;
use App\MoonShine\Resources\User\UserResource;
use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\MenuManager\MenuGroup;
use MoonShine\MenuManager\MenuItem;

final class MoonShineLayout extends AppLayout
{
    /**
     * MoonShine v4 signature: MenuItem::make($filler, $label, $icon, $blank)
     */
    protected function menu(): array
    {
        return [
            MenuItem::make(DashboardPage::class, 'Dashboard', 'home'),

            MenuGroup::make('Content', [
                MenuItem::make(PostResource::class, 'Posts', 'document-text'),
                MenuItem::make(CategoryResource::class, 'Categories', 'folder'),
            ], 'squares-2x2'),

            MenuGroup::make('Administration', [
                MenuItem::make(UserResource::class, 'Users', 'users'),
                MenuItem::make(RoleResource::class, 'Roles', 'key'),
            ], 'shield-check'),
        ];
    }
}
