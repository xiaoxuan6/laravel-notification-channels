<?php

namespace Vinhson\LaravelNotifications\Channels;

use Illuminate\Support\Facades\Http;
use Vinhson\LaravelNotifications\Notifications\LarkNotification;

class LarkChannel extends AbstractChannel
{
    public function send($notifiable, LarkNotification $notification)
    {
        $payload = [
            'msg_type' => 'text',
            'content' => [
                'text' => $notification->toLark(),
            ],
        ];

        $url = 'https://open.feishu.cn/open-apis/bot/v2/hook/'.$this->config->get('laravel-notifications.lark.access_token');
        Http::withoutVerifying()
            ->withMiddleware($this->handle())
            ->post($url, $payload);
    }
}
