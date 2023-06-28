<?php
/**
 * This file is part of james.xue/laravel-notification-channels.
 *
 * (c) xiaoxuan6 <15227736751@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vinhson\LaravelNotifications;

use Illuminate\Support\ServiceProvider;

class LaravelNotificationsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/laravel-notifications.php', 'laravel-notifications');
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__ . '/../config/laravel-notifications.php' => config_path('laravel-notifications.php')], 'laravel-notification-channels');
        }
    }
}
