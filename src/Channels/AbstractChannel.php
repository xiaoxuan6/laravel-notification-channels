<?php

namespace Vinhson\LaravelNotifications\Channels;

use Illuminate\Config\Repository;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;

class AbstractChannel
{
    public function __construct(
        protected Repository $config
    ) {
    }

    /**
     * @param  Response  $response
     */
    public function writer(Response $response)
    {
        if ($this->config->get('laravel-notifications.log_enable')) {
            Log::info('send response：', $response->json() ?? []);
        }
    }
}
