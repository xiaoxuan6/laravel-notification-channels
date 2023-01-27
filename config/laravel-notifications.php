<?php

return [
    'log_enable' => env('LARAVEL_NOTIFICATIONS_LOG_ENABLE', true),

    'ding_talk' => [
        'access_token' => env('LARAVEL_NOTIFICATIONS_DING_TALK_ACCESS_TOKEN', ''),
        'send_type' => 'text', // support: text、markdown
    ],

    'lark' => [
        'access_token' => env('LARAVEL_NOTIFICATIONS_LARK_ACCESS_TOKEN', ''),
    ],

    'wechat' => [
        'key' => env('LARAVEL_NOTIFICATIONS_WECHAT_KEY', ''),
        'send_type' => 'text', // support: text、markdown
    ],

    'server' => [
        'webhook' => env('LARAVEL_NOTIFICATIONS_SERVER_WEBHOOK', ''),
    ],

    'push_plus' => [
        'token' => env('LARAVEL_NOTIFICATIONS_PUSH_PLUS_TOKEN', ''),
    ],
];
