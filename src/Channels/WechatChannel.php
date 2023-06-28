<?php
/**
 * This file is part of james.xue/laravel-notification-channels.
 *
 * (c) xiaoxuan6 <15227736751@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vinhson\LaravelNotifications\Channels;

use Illuminate\Support\Facades\Http;
use Vinhson\LaravelNotifications\Notifications\WechatNotification;

class WechatChannel extends AbstractChannel
{
    public function send($notifiable, WechatNotification $notification): void
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

        $url = 'https://qyapi.weixin.qq.com/cgi-bin/webhook/send?key=' . $this->config->get('laravel-notifications.wechat.key');
        $response = Http::withoutVerifying()
            ->withMiddleware($this->handle())
            ->post($url, $payload);

        $this->sendCallableNotify($response);
    }
}
