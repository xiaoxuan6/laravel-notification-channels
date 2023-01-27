<?php

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
