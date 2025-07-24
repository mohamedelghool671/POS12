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
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses'      => [
        'key'    => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend'   => [
        'key' => env('RESEND_KEY'),
    ],

    'slack'    => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel'              => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'github'   => [
        'client_id'     => env('GITHUB_CLIENT_ID','Iv23lifUp4hETBzSFGke'),
        'client_secret' => env('GITHUB_CLIENT_SECRET','3ca7b30b5a73bafe3aa4227e8860de469dffaab7'),
        'redirect'      => 'http://127.0.0.1:8001/auth/github/callback',
    ],

    'google'   => [
        'client_id'     => env('GOOGLE_CLIENT_ID','469066589293-o8sv4ecmo2ijla7vmh3iv61baqg80hp6.apps.googleusercontent.com'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET','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'),
        'redirect'      => 'http://127.0.0.1:8001/auth/google/callback',
    ],

];
