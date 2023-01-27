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
        $message = $notification->toDingTalk();

        $payload = match ($this->config->get('laravel-notifications.ding_talk.send_type', 'text')) {
            'text', 'default' => [
                'msgtype' => 'text',
                'text' => [
                    'content' => $message,
                ],
            ],
            'markdown' => [
                'msgtype' => 'markdown',
                'markdown' => [
                    'title' => $notification->getTitle(),
                    'text' => $message,
                ],
            ],
        };

        $url = 'https://oapi.dingtalk.com/robot/send?access_token='.$this->config->get('laravel-notifications.ding_talk.access_token');

        $response = Http::withoutVerifying()
            ->withHeaders(['Content-Type' => 'application/json;charset=utf-8'])
            ->withMiddleware($this->handle())
            ->post($url, $payload);

        $this->sendCallableNotify($response);
    }
}
