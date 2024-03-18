<?php
/**
 * This file is part of james.xue/laravel-notification-channels.
 *
 * (c) xiaoxuan6 <1527736751@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vinhson\LaravelNotifications\Notifications;

use JetBrains\PhpStorm\{ArrayShape, Pure};
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

    /**
     * @return array{title: string, content: string}
     */
    #[ArrayShape(['title' => 'string', 'content' => 'string'])]
    public function toXiZhi(): array
    {
        return ['title' => $this->title, 'content' => $this->message];
    }
}
