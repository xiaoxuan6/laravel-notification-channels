<?php

namespace Vinhson\LaravelNotifications\Channels;

use Illuminate\Support\Facades\Http;
use Vinhson\LaravelNotifications\Notifications\WechatNotification;

class WechatChannel extends AbstractChannel
{
    public function send($notifiable, WechatNotification $notification)
    {
        $message = $notification->toWechat();

        $payload = match ($this->config->get('laravel-notifications.wechat.send_type')) {
            'text', 'default' => [
                'msgtype' => 'text',
                'text' => [
                    'content' => $message,
                ],
            ],
            'markdown' => [
                'msgtype' => 'markdown',
                'markdown' => [
                    'content' => $message,
                ],
            ]
        };

        $url = 'https://qyapi.weixin.qq.com/cgi-bin/webhook/send?key='.$this->config->get('laravel-notifications.wechat.key');
        Http::withoutVerifying()
            ->withMiddleware($this->handle())
            ->post($url, $payload);
    }
}
