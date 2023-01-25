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
                    'content' => $message,
                ],
            ],
            'markdown' => [
                'msg_type' => 'post',
                'content' => [
                    'post' => [
                        'zh_cn' => [
                            'title' => $title,
                            'content' => $message,
                        ],
                    ],
                ],
            ],
        };

        $url = 'https://open.feishu.cn/open-apis/bot/v2/hook/'.$this->config->get('laravel-notifications.lark.access_token');
        $response = Http::withoutVerifying()->post($url, $payload)->json();

        $this->writer($response);
    }
}
