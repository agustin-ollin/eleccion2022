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
    #--- agregar este bloque
    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID', '422917370039379'),
        'client_secret' =>
            env('FACEBOOK_CLIENT_SECRET',
                'e22156b889606b5b6ed3aebe302b8756'),
        'redirect' =>
            env('FACEBOOK_REDIRECT',
                'http://localhost:8888/login/facebook/callback')
    ],

];
