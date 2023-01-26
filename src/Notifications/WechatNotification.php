<?php

namespace Vinhson\LaravelNotifications\Notifications;

use Vinhson\LaravelNotifications\Channels\WechatChannel;

class WechatNotification extends AbstractNotification
{
    public function via($notifiable): array
    {
        return [WechatChannel::class];
    }

    public function toWechat($notifiable): string
    {
        return $this->message;
    }
}
