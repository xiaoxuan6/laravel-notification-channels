<?php

namespace Vinhson\LaravelNotifications\Channels;

use Illuminate\Support\Facades\Http;
use Vinhson\LaravelNotifications\Notifications\DingTalkNotification;

class DingTalkChannel extends AbstractChannel
{
    /**
     * @param $notifiable
     * @param DingTalkNotification $notification
     */
    public function send($notifiable, DingTalkNotification $notification)
    {
        $title = $notification->getTitle();
        $message = $notification->toDingTalk($notifiable);

        $payload = match ($this->config->get('laravel-notifications.ding_talk.send_type', 'text')) {
            'text', 'default' => [
                'msgtype' => 'text',
                'text' => [
                    'content' => $message,
                ]
            ],
            'markdown' => [
                'msgtype' => 'markdown',
                'markdown' => [
                    'title' => $title,
                    'text' => $message,
                ],
            ],
        };

        $url = 'https://oapi.dingtalk.com/robot/send?access_token=' . $this->config->get('laravel-notifications.ding_talk.access_token');

        Http::withoutVerifying()
            ->withHeaders(['Content-Type' => 'application/json;charset=utf-8'])
            ->withMiddleware($this->handle())
            ->post($url, $payload);

    }
}
