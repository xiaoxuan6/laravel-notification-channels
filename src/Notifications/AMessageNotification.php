<?php

namespace Vinhson\LaravelNotifications\Notifications;

use JetBrains\PhpStorm\Pure;
use Vinhson\LaravelNotifications\Channels\AMessageChannel;

class AMessageNotification extends AbstractNotification
{
    #[Pure]
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
