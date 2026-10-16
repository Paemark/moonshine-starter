<?php

declare(strict_types=1);

namespace App\Policies;

use Spatie\Csp\Directive;
use Spatie\Csp\Keyword;
use Spatie\Csp\Policy;
use Spatie\Csp\Preset;

class CspPolicy implements Preset
{
    public function configure(Policy $policy): void
    {
        // Start with the package's standard security policy.
        (new \Spatie\Csp\Presets\Basic())->configure($policy);

        // Permit the external Inter stylesheet from Bunny Fonts.
        $policy->add(
            Directive::STYLE,
            'https://fonts.bunny.net'
        );

        // Permit font files served by Bunny Fonts.
        $policy->add(
            Directive::FONT,
            'https://fonts.bunny.net'
        );
    }
}
