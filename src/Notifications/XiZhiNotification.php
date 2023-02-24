<?php

namespace Vinhson\LaravelNotifications\Notifications;

use JetBrains\PhpStorm\ArrayShape;
use JetBrains\PhpStorm\Pure;
use Vinhson\LaravelNotifications\Channels\XiZhiChannel;

class XiZhiNotification extends AbstractNotification
{
    #[Pure]
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

    #[ArrayShape(['title' => "string", 'content' => "string"])]
    public function toXiZhi(): array
    {
        return ['title' => $this->title, 'content' => $this->message];
    }
}
