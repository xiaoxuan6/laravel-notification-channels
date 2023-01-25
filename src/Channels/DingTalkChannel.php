<?php

namespace Vinhson\LaravelNotifications\Channels;

use Illuminate\Support\Facades\Http;
use Vinhson\LaravelNotifications\Notifications\DingTalkNotification;

class DingTalkChannel extends AbstractChannel
{
    /**
     * @param $notifiable
     * @param  DingTalkNotification  $notification
     */
    public function send($notifiable, DingTalkNotification $notification)
    {
        $title = $notification->getTitle();
        $message = $notification->toDingTalk($notifiable);

        $payload = match ($this->config->get('laravel-notifications.ding_talk.send_type', 'text')) {
            'text', 'default' => [
                'msg_type' => 'text',
                'content' => [
                    'content' => $message,
                ],
            ],
            'markdown' => [
                'msg_type' => 'markdown',
                'markdown' => [
                    'title' => $title,
                    'text' => $message,
                ],
            ],
        };

        $url = 'https://oapi.dingtalk.com/robot/send?access_token='.$this->config->get('laravel-notifications.ding_talk.access_token');

        $response = Http::withoutVerifying()->withHeaders(['Content-Type' => 'application/json;charset=utf-8'])->post($url, $payload);

        $this->writer($response);
    }
}
