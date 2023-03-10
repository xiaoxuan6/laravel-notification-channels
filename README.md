# laravel-notification-channels

# Install

```php
composer require james.xue/laravel-notification-channels
```

# Publish Config

```php
php artisan make:vendor publish --tag=laravel-notification-channels
```

# Environment

Modify correspondence channel `env` configuration

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

# Support Channel

|Channel|Notification|
|:---|:---|
|钉钉|DingTalkNotification::class|
|企微|WechatNotification::class|
|飞书|LarkNotification::class|
|pushplus|PushPlusNotification::class|
|Server 酱|ServerNotification::class|
|一封传话|AMessageNotification::class|
|息知|XiZhiNotification::class|