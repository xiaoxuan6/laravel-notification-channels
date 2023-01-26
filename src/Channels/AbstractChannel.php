<?php

namespace Vinhson\LaravelNotifications\Channels;

use GuzzleHttp\Psr7\{Request, Response};
use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Log;
use Psr\Http\Message\{RequestInterface};

class AbstractChannel
{
    public function __construct(
        protected Repository $config
    )
    {
    }

    public function handle(): callable
    {
        $config = $this->config;

        return static function (callable $handler) use ($config): callable {
            return static function (RequestInterface $request, array $options) use ($handler, $config) {

                $log_enable = $config->get('laravel-notifications.log_enable');

                if ($log_enable) {

                    $before = function (Request $request, $options) {
                        $response = json_decode($request->getBody()->getContents(), JSON_UNESCAPED_UNICODE);
                        Log::info('notification send require：', $response);
                    };

                    $before($request, $options);
                }

                $response = $handler($request, $options);

                if ($log_enable) {

                    $after = function (Request $request, $options, $response) {
                        if (!$response instanceof Response) {
                            $response = $response->wait(true);
                        }
                        $status = $response->getStatusCode();
                        $response = $response->getBody()->getContents();
                        Log::info('notification send response：', json_decode($response, JSON_UNESCAPED_UNICODE));
                    };

                    $after($request, $options, $response);
                }

                return $response;
            };
        };
    }
}
