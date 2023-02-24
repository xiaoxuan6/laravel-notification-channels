<?php

namespace Vinhson\LaravelNotifications\Notifications;

use JetBrains\PhpStorm\Pure;
use Vinhson\LaravelNotifications\Channels\DingTalkChannel;

class DingTalkNotification extends AbstractNotification
{
    #[Pure]
    public function __construct(
        protected string $title,
        protected string $message,
    ) {
        parent::__construct($this->message);
    }

    /**
     * @param $notifiable
     * @return string[]
     */
    public function via($notifiable): array
    {
        return [DingTalkChannel::class];
    }

    public function toDingTalk(): string
    {
        return $this->message;
    }

    public function getTitle(): string
    {
        return $this->title ?? '';
    }
}
