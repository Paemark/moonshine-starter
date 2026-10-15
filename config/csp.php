<?php

return [
    'policy' => Spatie\Csp\Policies\Basic::class,

    'report_uri' => env('CSP_REPORT_URI', ''),

    'enabled' => env('CSP_ENABLED', true),

    'nonce' => env('CSP_NONCE', ''),

    'report_only' => env('CSP_REPORT_ONLY', false),

    'profiles' => [
        Spatie\Csp\Policies\Basic::class => [
            'default' => ["'self'"],
            'img' => ["'self'", 'data:', 'https://www.gravatar.com'],
            'script' => ["'self'", "'unsafe-inline'", "'unsafe-eval'"], // Adjust for production
            'style' => ["'self'", "'unsafe-inline'"],
            'font' => ["'self'", 'data:'],
            'connect' => ["'self'"],
            'frame' => ["'none'"], // Prevents Clickjacking
        ],
    ],
];