<?php

namespace Vinhson\LaravelNotifications\Notifications;

use Vinhson\LaravelNotifications\Channels\PushPlusChannel;

class PushPlusNotification extends AbstractNotification
{
    public function __construct(
        protected string $title,
        protected string $message
    ) {
        parent::__construct($this->message);
    }

    public function via($notifiable): array
    {
        return [PushPlusChannel::class];
    }

    public function toPushPlus(): string
    {
        return $this->message;
    }

    public function getTitle(): string
    {
        return $this->message ?? '';
    }
}
