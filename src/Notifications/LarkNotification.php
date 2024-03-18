<?php
/**
 * This file is part of james.xue/laravel-notification-channels.
 *
 * (c) xiaoxuan6 <1527736751@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vinhson\LaravelNotifications\Notifications;

use Vinhson\LaravelNotifications\Channels\LarkChannel;

class LarkNotification extends AbstractNotification
{
    /**
     * @param $notifiable
     * @return string[]
     */
    public function via($notifiable): array
    {
        return [LarkChannel::class];
    }

    /**
     * @return string
     */
    public function toLark(): string
    {
        return $this->message;
    }
}
