<?php
/**
 * This file is part of james.xue/laravel-notification-channels.
 *
 * (c) xiaoxuan6 <1527736751@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vinhson\LaravelNotifications\Channels;

use Illuminate\Support\Facades\Http;
use Vinhson\LaravelNotifications\Notifications\PushPlusNotification;

class PushPlusChannel extends AbstractChannel
{
    public function send($notifiable, PushPlusNotification $notification): void
    {
        $payload = [
            'token' => $this->config->get('laravel-notifications.push_plus.token'),
            'title' => $notification->getTitle(),
            'content' => $notification->toPushPlus(),
        ];

        $response = Http::withoutVerifying()
            ->withMiddleware($this->handle())
            ->withHeaders(['Content-Type' => 'application/json'])
            ->post('https://www.pushplus.plus/send', $payload);

        $this->sendCallableNotify($response);
    }
}
