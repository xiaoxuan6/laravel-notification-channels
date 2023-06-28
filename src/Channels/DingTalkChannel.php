<?php
/**
 * This file is part of james.xue/laravel-notification-channels.
 *
 * (c) xiaoxuan6 <15227736751@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vinhson\LaravelNotifications\Channels;

use Illuminate\Support\Facades\Http;
use Vinhson\LaravelNotifications\Notifications\DingTalkNotification;

class DingTalkChannel extends AbstractChannel
{
    public function send($notifiable, DingTalkNotification $notification): void
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

        $url = 'https://oapi.dingtalk.com/robot/send?access_token=' . $this->config->get('laravel-notifications.ding_talk.access_token');

        $response = Http::withoutVerifying()
            ->withHeaders(['Content-Type' => 'application/json;charset=utf-8'])
            ->withMiddleware($this->handle())
            ->post($url, $payload);

        $this->sendCallableNotify($response);
    }
}
