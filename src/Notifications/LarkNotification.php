<?php

namespace Vinhson\LaravelNotifications\Notifications;

use Illuminate\Notifications\Notification;
use Vinhson\LaravelNotifications\Channels\LarkChannel;

class LarkNotification extends Notification
{
    public function __construct(
        protected string $title,
        protected string $message
    ) {
    }

    /**
     * @param $notifiable
     * @return string[]
     */
    public function via($notifiable): array
    {
        return [LarkChannel::class];
    }

    /**
     * @param $notifiable
     * @return string
     */
    public function toLark($notifiable): string
    {
        return $this->message;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
