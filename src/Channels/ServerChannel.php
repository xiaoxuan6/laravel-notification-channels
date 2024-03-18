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
use Vinhson\LaravelNotifications\Notifications\ServerNotification;

class ServerChannel extends AbstractChannel
{
    public function send($notifiable, ServerNotification $notification): void
    {
        $payload = [
            'title' => $notification->getTitle(),
            'desp' => $notification->toServer(),
            'channel' => 9,
        ];

        $url = sprintf('https://sctapi.ftqq.com/%s.send', $this->config->get('laravel-notifications.server.webhook'));
        $response = Http::withoutVerifying()
            ->withMiddleware($this->handle())
            ->post($url, $payload);

        $this->sendCallableNotify($response);
    }
}
