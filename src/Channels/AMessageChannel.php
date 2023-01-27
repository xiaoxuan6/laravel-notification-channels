<?php

namespace Vinhson\LaravelNotifications\Channels;

use Illuminate\Support\Facades\Http;
use Vinhson\LaravelNotifications\Notifications\AMessageNotification;

class AMessageChannel extends AbstractChannel
{
    public function send($notifiable, AMessageNotification $notification)
    {
        $payload = [
            'head' => urlencode($notification->getTitle()),
            'body' => urlencode($notification->toAMessage()),
        ];

        $token = $this->config->get('laravel-notifications.a_message.token');

        $response = Http::withoutVerifying()
            ->get('https://www.phprm.com/services/push/trigger/'.$token.'?'.http_build_query($payload));

        $this->sendCallableNotify($response);
    }
}
