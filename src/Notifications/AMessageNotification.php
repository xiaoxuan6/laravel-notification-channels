<?php

namespace Vinhson\LaravelNotifications\Notifications;

use Vinhson\LaravelNotifications\Channels\AMessageChannel;

class AMessageNotification extends AbstractNotification
{
    public function __construct(
        protected string $title,
        protected string $message
    ) {
        parent::__construct($this->message);
    }

    public function via($notifiable): array
    {
        return [AMessageChannel::class];
    }

    public function toAMessage(): string
    {
        return $this->message;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
