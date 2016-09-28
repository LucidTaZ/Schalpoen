<?php
/**
 * Application configuration shared by all test types
 */
return [
    'language' => 'nl',
    'controllerMap' => [
        'fixture' => [
            'class' => 'yii\faker\FixtureController',
            'fixtureDataPath' => '@tests/fixtures',
            'templatePath' => '@tests/templates',
            'namespace' => 'tests\fixtures',
        ],
    ],
    'components' => [
//        'db' => [
//            'dsn' => 'mysql:host=localhost;dbname=yii2_basic_tests',
//        ],
        'mailer' => [
            'useFileTransport' => true,
        ],
        'urlManager' => [
            'showScriptName' => true,
        ],
    ],
];
