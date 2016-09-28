<?php

/**
 * Application configuration for functional tests
 */
return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/../../../config/console.php'),
    require(__DIR__ . '/config.php'),
    [
        'components' => [
            'db' => [
                'dsn' => 'sqlite:@runtime/integration.db',
            ],
        ],
    ]
);
