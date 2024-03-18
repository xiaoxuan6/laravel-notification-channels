<?php

declare(strict_types=1);
/**
 * This file is part of james.xue/laravel-notification-channels.
 *
 * (c) xiaoxuan6 <1527736751@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\{LevelSetList, SetList};

return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/config',
        __DIR__ . '/src',
    ]);

    // define sets of rules
    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_80,
        SetList::PHP_80,
        SetList::EARLY_RETURN,
        SetList::TYPE_DECLARATION,
    ]);
};
