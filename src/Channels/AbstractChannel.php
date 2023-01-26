<?php

namespace Vinhson\LaravelNotifications\Channels;

use Illuminate\Config\Repository;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;

class AbstractChannel
{
    public function __construct(
        protected Repository $config
    ) {
    }

    public function handle(): callable
    {
        $config = $this->config;

        return static function (callable $handler) use ($config): callable {
            return static function (Request $request, array $options) use ($handler, $config) {
                $log_enable = $config->get('laravel-notifications.log_enable');

                if ($log_enable) {
                    $before = function (Request $request, $options) {
                        Log::info('notification send require：', $request->data());
                    };

                    $before($request, $options);
                }

                $response = $handler($request, $options);

                if ($log_enable) {
                    $after = function (Request $request, $options, Response $response) {
                        Log::info('notification send response：', $response->json());
                    };

                    $after($request, $options, $response);
                }

                return $response;
            };
        };
    }
}
