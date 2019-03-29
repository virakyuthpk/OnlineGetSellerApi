<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'facebook' => [
        'client_id' => ('364156690742149'),
        'client_secret' => ('8ea72428b0d8b9dbb35bdff56526b5d8'),
        'redirect' => ('https://onlineget.com/api/login/facebook/callback'),
    ], 
    'google' => [
        'client_id' => '711744501441-146qla4onhtv6ulhg9jpp75rjv6kktcm.apps.googleusercontent.com',
        'client_secret' => '5gjaijUekeUSOXdlOCStL0HC',
        'redirect' => 'https://onlineget.com/api/login/google/callback',
    ],

];
