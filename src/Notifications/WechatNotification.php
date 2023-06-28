<?php
/**
 * This file is part of james.xue/laravel-notification-channels.
 *
 * (c) xiaoxuan6 <15227736751@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vinhson\LaravelNotifications\Notifications;

use Vinhson\LaravelNotifications\Channels\WechatChannel;

class WechatNotification extends AbstractNotification
{
    public function via($notifiable): array
    {
        return [WechatChannel::class];
    }

    public function toWechat(): string
    {
        return $this->message;
    }
}
