<?php

namespace Vinhson\LaravelNotifications\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

abstract class AbstractNotification extends Notification
{
    use Queueable;

    public function __construct(
        protected string $message
    ) {
    }

    abstract public function via($notifiable): array;
}
