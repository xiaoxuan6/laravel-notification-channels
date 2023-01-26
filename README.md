# laravel-notification-channels

# Install

```shell
composer require james.xue/laravel-notification-channels
```

# Publish Config

```shell
php artisan make:vendor publish --tag=laravel-notification-channels
```

# Environment

### Log enable

```shell
LARAVEL_NOTIFICATIONS_LOG_ENABLE=true
```

### Ding_talk access_token

```shell
LARAVEL_NOTIFICATIONS_DING_TALK_ACCESS_TOKEN=xxx
```

### Lark access_token

```shell
LARAVEL_NOTIFICATIONS_LARK_ACCESS_TOKEN=xxx
```

# Usage

```shell
use Illuminate\Support\Facades\Notification;
use Vinhson\LaravelNotifications\Notifications\DingTalkNotification;

Notification::send(new DingTalkNotification($title, $message));
or 
Notification::send(new DingTalkNotification(message: $message));
```