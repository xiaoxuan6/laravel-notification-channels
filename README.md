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

```php
use Illuminate\Support\Facades\Notification;
use Vinhson\LaravelNotifications\Notifications\DingTalkNotification;

Notification::send($this, new DingTalkNotification($title, $message));
or 
Notification::send($this, new DingTalkNotification(message: $message));
```

```php
class NotifyController extends Controller
{
    use Notifiable;

    public function index()
    {
        $user = User::factory()->create();

        $this->notify(new DingTalkNotification('通知', '【golang】姓名：' . $user->name . ' 邮箱:' . $user->email));

        config()->set('laravel-notifications.ding_talk.send_type', 'markdown');
        $data = "#### \n > golang】姓名：" . $user->name . " # 邮箱:" . $user->email;
        $this->notify(new DingTalkNotification('Markdown 通知', $data));

        return 'ok';
    }
}
```
