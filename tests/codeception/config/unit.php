<?php

use tests\unit\ForbidDatabaseUsage;
use yii\helpers\ArrayHelper;

/**
 * Application configuration for unit tests
 */
return ArrayHelper::merge(
    require(__DIR__ . '/../../../config/web.php'),
    require(__DIR__ . '/config.php'),
    [
        'bootstrap' => [ForbidDatabaseUsage::class],
    ]
);
