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
use Vinhson\LaravelNotifications\Notifications\LarkNotification;

class LarkChannel extends AbstractChannel
{
    public function send($notifiable, LarkNotification $notification): void
    {
        $payload = [
            'msg_type' => 'text',
            'content' => [
                'text' => $notification->toLark(),
            ],
        ];

        $url = 'https://open.feishu.cn/open-apis/bot/v2/hook/' . $this->config->get('laravel-notifications.lark.access_token');
        $response = Http::withoutVerifying()
            ->withMiddleware($this->handle())
            ->post($url, $payload);

        $this->sendCallableNotify($response);
    }
}
