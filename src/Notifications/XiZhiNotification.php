<?php

namespace Vinhson\LaravelNotifications\Notifications;

use Vinhson\LaravelNotifications\Channels\XiZhiChannel;

class XiZhiNotification extends AbstractNotification
{
    public function __construct(
        protected string $title,
        protected string $message,
    ) {
        parent::__construct($this->message);
    }

    public function via($notifiable): array
    {
        return [XiZhiChannel::class];
    }

    public function toXiZhi(): array
    {
        return ['title' => $this->title, 'content' => $this->message];
    }
}
