<?php

namespace Vinhson\LaravelNotifications\Notifications;

use Illuminate\Bus\Queueable;
use Vinhson\LaravelNotifications\Channels\DingTalkChannel;

class DingTalkNotification extends AbstractNotification
{
    use Queueable;

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
