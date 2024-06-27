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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'google' => [
        'client_id' => '355385253604-k7fo4pd2vco70bldlnhh10qet3obd43j.apps.googleusercontent.com',
        'client_secret' => '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',
        // 'redirect' => 'http://localhost:8080/auth/google/callback',
        'redirect' => 'https://costacaster.instantsolutionslab.site/auth/google/callback',
    ],
    'facebook' => [
        'client_id' => '3557689644490408',
        'client_secret' => 'b9864a454ab6eb90a3facefd39716066',
        // 'redirect' => 'http://localhost:8080/auth/facebook/callback',
        'redirect' => 'https://costacaster.instantsolutionslab.site/auth/facebook/callback',
    ],

];
