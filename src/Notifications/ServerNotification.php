<?php

namespace Vinhson\LaravelNotifications\Notifications;

use JetBrains\PhpStorm\Pure;
use Vinhson\LaravelNotifications\Channels\ServerChannel;

class ServerNotification extends AbstractNotification
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
        return [ServerChannel::class];
    }

    public function toServer(): string
    {
        return $this->message;
    }

    public function getTitle(): string
    {
        return $this->title ?? '';
    }
}
