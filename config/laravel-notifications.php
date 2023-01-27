<?php

return [
    // 是否开启 log 日志
    'log_enable' => env('LARAVEL_NOTIFICATIONS_LOG_ENABLE', true),

    // 钉钉自定义群机器人
    'ding_talk' => [
        'access_token' => env('LARAVEL_NOTIFICATIONS_DING_TALK_ACCESS_TOKEN', ''),
        'send_type' => 'text', // support: text、markdown
    ],

    // 飞书自定义群机器人
    'lark' => [
        'access_token' => env('LARAVEL_NOTIFICATIONS_LARK_ACCESS_TOKEN', ''),
    ],

    // 企微自定义机器人
    'wechat' => [
        'key' => env('LARAVEL_NOTIFICATIONS_WECHAT_KEY', ''),
        'send_type' => 'text', // support: text、markdown
    ],

    // Server 酱
    'server' => [
        'webhook' => env('LARAVEL_NOTIFICATIONS_SERVER_WEBHOOK', ''),
    ],

    // pushPlus
    'push_plus' => [
        'token' => env('LARAVEL_NOTIFICATIONS_PUSH_PLUS_TOKEN', ''),
    ],

    // 一封传话
    'a_message' => [
        'token' => env('LARAVEL_NOTIFICATIONS_A_MESSAGE_TOKEN', ''),
    ],
];
