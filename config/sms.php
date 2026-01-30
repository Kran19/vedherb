<?php

return [
    'username' => env('SMS_USERNAME'),
    'api_key' => env('SMS_API_KEY'),
    'sender_id' => env('SMS_SENDER_ID'),
    'api_url' => 'https://allsmssolution.in/sms-panel/api/http/index.php',

    'templates' => [
        'refund' => '1707176891267216809',
        'order_cancelled' => '1707176891247918907',
        'payment_failed' => '1707176891234403346',
        'otp' => '1707176891212722808',
        'dispatched' => '1707176891198280715',
        'welcome' => '1707176891176823144',
        'order_placed' => '1707176891162262938',
    ],
];
