<?php

namespace Vinhson\LaravelNotifications\Channels;

use Illuminate\Support\Facades\Http;
use Vinhson\LaravelNotifications\Notifications\ServerNotification;

class ServerChannel extends AbstractChannel
{
    public function send($notifiable, ServerNotification $notification)
    {
        $title = $notification->getTitle();
        $message = $notification->toServer();

        $payload = [
            'title' => $title,
            'desp' => $message,
            'channel' => 9,
        ];

        $url = sprintf('https://sctapi.ftqq.com/%s.send', $this->config->get('laravel-notifications.server.webhook'));
        Http::withoutVerifying()
            ->withMiddleware($this->handle())
            ->asForm()
            ->post($url, $payload);
    }
}
