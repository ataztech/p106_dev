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
        'client_id'     => '557262404618545',
        'client_secret' => 'c6efef9e7e6182c21afc361b2021a738',
        'redirect'      => 'http://localhost:8080/p101/auth/facebook/callback',
    ],
    'google' => [
        'client_id' => '529642959764-js7of4c3jpmfdu8gnakku6p4eprse82r.apps.googleusercontent.com',
        'client_secret' => '9lIGWomqrcb8iv2AYGaVkkor',
        'redirect' => 'http://localhost:8080/p101/auth/google/callback',
    ]

];
