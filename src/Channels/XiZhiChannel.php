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
use Vinhson\LaravelNotifications\Notifications\XiZhiNotification;

class XiZhiChannel extends AbstractChannel
{
    public function send($notifiable, XiZhiNotification $notification): void
    {
        $url = sprintf('https://xizhi.qqoq.net/%s.send', $this->config->get('laravel-notifications.xi_zhi.token'));
        $response = Http::withoutVerifying()
            ->withMiddleware($this->handle())
            ->post($url, $notification->toXiZhi());

        $this->sendCallableNotify($response);
    }
}
