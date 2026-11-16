<?php

/**
 * Cross-Origin Resource Sharing (CORS) Configuration
 *
 * Configures allowed origins for the standalone React (Vite) frontend
 * deployed on Vercel and local Vite development servers.
 */

declare(strict_types=1);

$frontendUrl = trim((string) env('FRONTEND_URL', 'https://eng-abdulrahman-abu-eisha.vercel.app'));
$configuredOrigins = array_map(
    static fn (string $origin): string => rtrim(trim($origin), '/'),
    explode(
        ',',
        (string) env(
            'CORS_ALLOWED_ORIGINS',
            'https://eng-abdulrahman-abu-eisha.vercel.app,http://localhost:5173,http://127.0.0.1:5173'
        )
    )
);

$allowedOrigins = array_values(array_unique(array_filter(array_merge(
    [$frontendUrl !== '' ? rtrim($frontendUrl, '/') : null],
    $configuredOrigins,
    [
        'https://eng-abdulrahman-abu-eisha.vercel.app',
        'http://localhost:5173',
        'http://127.0.0.1:5173',
    ]
))));

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['GET', 'POST', 'OPTIONS', 'HEAD'],

    'allowed_origins' => $allowedOrigins,

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['Content-Type', 'Accept', 'Accept-Language', 'Origin', 'X-Requested-With', 'If-None-Match'],

    'exposed_headers' => ['ETag', 'Cache-Control', 'X-RateLimit-Limit', 'X-RateLimit-Remaining'],

    'max_age' => 86400,

    'supports_credentials' => false,

];
