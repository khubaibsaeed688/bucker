<?php

return [

    'gateway' => env('PAYMENT_GATEWAY', 'safepay'),

    'mode' => env('PAYMENT_MODE', 'sandbox'),

    'currency' => 'PKR',

    'currency_symbol' => 'Rs.',

    'safepay' => [

        'base_url' => env(
            'SAFEPAY_BASE_URL',
            'https://sandbox.api.getsafepay.com'
        ),

        'secret_key' => env('SAFEPAY_SECRET_KEY'),

        'public_key' => env('SAFEPAY_PUBLIC_KEY'),

        'webhook_secret' => env('SAFEPAY_WEBHOOK_SECRET'),

    ],

];