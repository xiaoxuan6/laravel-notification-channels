<?php

namespace Vinhson\LaravelNotifications\Channels;

use GuzzleHttp\Promise\FulfilledPromise;
use GuzzleHttp\Psr7\Request;
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
     * writer log
     *
     * @return callable
     */
    public function handle(): callable
    {
        $config = $this->config;

        return static function (callable $handler) use ($config): callable {
            return static function (Request $request, array $options) use ($handler, $config) {
                $log_enable = $config->get('laravel-notifications.log_enable');

                if ($log_enable) {
                    $before = function (Request $request, $options) {
                        Log::info('notification send require：', json_decode($request->getBody()->getContents(), JSON_UNESCAPED_UNICODE));
                    };

                    $before($request, $options);
                }

                $response = $handler($request, $options);

                if ($log_enable) {
                    $after = function (Request $request, $options, $response) {
                        if ($response instanceof FulfilledPromise) {
                            $response = $response->wait(true);
                        }

                        Log::info('notification send response：', json_decode($response->getBody()->getContents(), JSON_UNESCAPED_UNICODE) ?? []);
                    };

                    $after($request, $options, $response);
                }

                return $response;
            };
        };
    }

    /**
     * @param  Response  $response
     */
    public function sendCallableNotify(Response $response)
    {
        $callable = $this->config->get('laravel-notifications.notify');

        if (is_callable($callable)) {
            $callable($response);
        }
    }
}
