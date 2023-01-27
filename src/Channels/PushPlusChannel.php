<?php

namespace Vinhson\LaravelNotifications\Channels;

use Illuminate\Support\Facades\Http;
use Vinhson\LaravelNotifications\Notifications\PushPlusNotification;

class PushPlusChannel extends AbstractChannel
{
    public function send($notifiable, PushPlusNotification $notification)
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
