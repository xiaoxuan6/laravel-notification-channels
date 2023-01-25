<?php

namespace Vinhson\LaravelNotifications\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Vinhson\LaravelNotifications\Channels\DingTalkChannel;

class DingTalkNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected string $title,
        protected string $message,
    ) {
    }

    /**
     * @param $notifiable
     * @return string[]
     */
    public function via($notifiable): array
    {
        return [DingTalkChannel::class];
    }

    public function toDingTalk($notifiable): string
    {
        return $this->message;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
