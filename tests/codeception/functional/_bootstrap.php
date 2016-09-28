<?php

use tests\functional\MigrateTestDatabaseCommand;
use yii\web\Application;

Yii::setAlias('@tests', dirname(__DIR__));

(new MigrateTestDatabaseCommand([
    'wipeExistingDb' => true,
    'dbFile' => '@runtime/integration.db',
]))->execute();

// Prepare the actual web application (registers itself to Yii::$app)
new Application(require(dirname(__DIR__) . '/config/functional.php'));
