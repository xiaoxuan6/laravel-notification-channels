<?php

namespace Vinhson\LaravelNotifications\Notifications;

use Illuminate\Notifications\Notification;

abstract class AbstractNotification extends Notification
{
    public function __construct(
        protected string $message
    ) {
    }

    abstract public function via($notifiable): array;
}
