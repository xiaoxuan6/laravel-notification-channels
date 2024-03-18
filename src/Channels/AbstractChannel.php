<?php
/**
 * This file is part of james.xue/laravel-notification-channels.
 *
 * (c) xiaoxuan6 <1527736751@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
namespace Vinhson\LaravelNotifications\Channels;

use GuzzleHttp\Psr7\Request;
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Client\Response;
use GuzzleHttp\Promise\FulfilledPromise;

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

        return static fn (callable $handler): callable => static function (Request $request, array $options) use ($handler, $config) {
            $log_enable = $config->get('laravel-notifications.log_enable');

            if ($log_enable) {
                $before = function (Request $request, $options): void {
                    Log::info('notification send require：', json_decode($request->getBody()->getContents(), JSON_UNESCAPED_UNICODE, 512, JSON_THROW_ON_ERROR));
                };

                $before($request, $options);
            }

            $response = $handler($request, $options);

            if ($log_enable) {
                $after = function (Request $request, $options, $response): void {
                    if ($response instanceof FulfilledPromise) {
                        $response = $response->wait(true);
                    }

                    Log::info('notification send response：', json_decode($response->getBody()->getContents(), JSON_UNESCAPED_UNICODE, 512, JSON_THROW_ON_ERROR) ?? []);
                };

                $after($request, $options, $response);
            }

            return $response;
        };
    }

    public function sendCallableNotify(Response $response): void
    {
        $callable = $this->config->get('laravel-notifications.callable');

        if (is_callable($callable)) {
            $callable($response);
        }
    }
}
