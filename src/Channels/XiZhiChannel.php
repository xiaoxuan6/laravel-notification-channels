<?php

namespace Vinhson\LaravelNotifications\Channels;

use Illuminate\Support\Facades\Http;
use Vinhson\LaravelNotifications\Notifications\XiZhiNotification;

class XiZhiChannel extends AbstractChannel
{
    public function send($notifiable, XiZhiNotification $notification)
    {
        $url = sprintf('https://xizhi.qqoq.net/%s.send', $this->config->get('laravel-notifications.xi_zhi.token'));
        $response = Http::withoutVerifying()
            ->withMiddleware($this->handle())
            ->post($url, $notification->toXiZhi());

        $this->sendCallableNotify($response);
    }
}
