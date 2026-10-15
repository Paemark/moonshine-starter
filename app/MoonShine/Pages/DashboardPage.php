<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use MoonShine\Laravel\Pages\Page;
use MoonShine\UI\Components\Alert;
use MoonShine\UI\Components\Layout\Box;

class DashboardPage extends Page
{
    protected string $title = 'Dashboard';

    protected string $subtitle = 'Enterprise Platform Overview';

    public function components(): array
    {
        return [
            Box::make('System Status', [
                Alert::make()->content('Successfully integrated MoonShine v4 with Fortify and Spatie Permissions.'),
            ]),
        ];
    }
}
