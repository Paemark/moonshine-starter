<?php

return [
    /*
     * A policy will determine which CSP headers will be set.
     */
    'presets' => [
        \App\Policies\CspPolicy::class,
    ],

    /*
     * This policy which will be put in report only mode.
     */
    'report_only_policy' => '',

    /*
     * All violations against the policy will be reported to this url.
     */
    'report_uri' => env('CSP_REPORT_URI', ''),

    /*
     * Headers will only be added if this setting is set to true.
     */
    'enabled' => env('CSP_ENABLED', true),

    /*
     * The class responsible for generating the nonces used in inline tags and headers.
     */
    'nonce_generator' => Spatie\Csp\Nonce\RandomString::class,

    /*
     * Set to true to add the `upgrade-insecure-requests` directive.
     */
    'upgrade_insecure_requests' => true,
];
