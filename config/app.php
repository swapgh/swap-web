<?php
declare(strict_types=1);

return [
    'name'             => 'Swap',
    'github_rpg'       => 'https://github.com/swapgh/swap-rpg',
    'github_web'       => 'https://github.com/swapgh/swap-web',
    'contact_email'    => 'swap@swap.com.es',
    'default_og_image' => 'images/favicons/faviconx512.png',
    'locale'           => 'en',
    'fallback_locale'  => 'en',
    'auth'             => [
        'api_token_ttl' => (int) ($_ENV['API_TOKEN_TTL'] ?? 2592000),
    ],
    'analytics'        => [
        'google_tag_id' => (string) ($_ENV['GOOGLE_TAG_ID'] ?? 'G-L611GK6Y4T'),
        'consent_version' => (string) ($_ENV['COOKIE_CONSENT_VERSION'] ?? '2026-04-14-ga4-v1'),
    ],
    'billing'          => [
        'mode' => (string) ($_ENV['BILLING_MODE'] ?? 'test'),
        'provider' => (string) ($_ENV['BILLING_PROVIDER'] ?? 'placeholder'),
        'public_key' => (string) ($_ENV['STRIPE_PUBLIC_KEY'] ?? ''),
        'secret_key' => (string) ($_ENV['STRIPE_SECRET_KEY'] ?? ''),
        'webhook_secret' => (string) ($_ENV['STRIPE_WEBHOOK_SECRET'] ?? ''),
        'success_url' => (string) ($_ENV['BILLING_SUCCESS_URL'] ?? ''),
        'cancel_url' => (string) ($_ENV['BILLING_CANCEL_URL'] ?? ''),
    ],
    'features'         => [
        'placeholder_auth' => false,
        'analytics'        => true,
        'billing'          => true,
    ],
];
