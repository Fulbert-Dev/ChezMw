<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    // PayGate
    'paygate' => [
        'token' => env('PAYGATE_API_TOKEN'),
        'simulation' => env('PAYGATE_SIMULATION', false),
        'network_prefixes' => [
            'flooz' => ['79', '96', '97', '98', '99'],
            'tmoney' => ['70', '71', '72', '73', '90', '91', '92', '93'],
        ],

        'page_url' => env(
            'PAYGATE_PAGE_URL',
            'https://paygateglobal.com/v1/page'
        ),

        'status_url' => env(
            'PAYGATE_STATUS_URL',
            'https://paygateglobal.com/api/v1/status'
        ),

        'status_identifier_url' => env(
            'PAYGATE_STATUS_IDENTIFIER_URL',
            'https://paygateglobal.com/api/v2/status'
        ),
    ],

];
