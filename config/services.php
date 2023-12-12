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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'stripe' => [
        'secret' => env('sk_test_51OKdR0JSrMtYZ273n6clpvbhiaoliwBUUIIslfchq4FkdAVhfUMK906Uc0m5WJCPhgRmvOiIbmqFgFnGutobeKbV00h8g71px9'),
        'public' => env('pk_test_51OKdR0JSrMtYZ273AbfiIh5rXPjeDtb1GKFw9EYC5q8r5ge4kjZYP8RDyex1DQzA5w5HubMnt6ej525LclP9ZKhz005qkwL5Lh'),
    ],    

];
