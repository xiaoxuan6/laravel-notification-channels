<?php

namespace Vinhson\LaravelNotifications;

use Illuminate\Support\ServiceProvider;

class LaravelNotificationsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-notifications.php', 'laravel-notifications');
        if ($this->app->runningInConsole()) {
            $this->publishes([__DIR__.'/../config/laravel-notifications.php' => config('laravel-notifications.php')], 'laravel-notification-channels');
        }
    }
}
