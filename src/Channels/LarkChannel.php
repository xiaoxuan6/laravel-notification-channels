<?php

namespace Vinhson\LaravelNotifications\Channels;

use Illuminate\Support\Facades\Http;
use Vinhson\LaravelNotifications\Notifications\LarkNotification;

class LarkChannel extends AbstractChannel
{
    public function send($notifiable, LarkNotification $notification)
    {
        $title = $notification->getTitle();
        $message = $notification->toLark($notifiable);

        $payload = match ($this->config->get('laravel-notifications.lark.send_type', 'text')) {
            'text', 'default' => [
                'msg_type' => 'text',
                'content' => [
                    'text' => $message,
                ],
            ]
        };

        $url = 'https://open.feishu.cn/open-apis/bot/v2/hook/'.$this->config->get('laravel-notifications.lark.access_token');
        Http::withoutVerifying()->withMiddleware($this->handle())->post($url, $payload)->json();
    }
}
