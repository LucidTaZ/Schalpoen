<?php

namespace tests\functional;

use Yii;
use yii\base\Component;
use yii\console\Application;
use yii\console\controllers\MigrateController;
use yii\db\Exception;
use yii\helpers\VarDumper;

class MigrateTestDatabaseCommand extends Component
{
    public $wipeExistingDb = false;
    public $dbFile; // Needs to be set if $wipeExistingDb is true
    public $consoleConfig = '@tests/config/console.php';

    public function execute()
    {
        // Prepare the application that will prepare the database
        $configPath = Yii::getAlias($this->consoleConfig);
        $app = new Application(require($configPath));

        // Wipe current integration DB
        if ($this->wipeExistingDb) {
            $dbFile = Yii::getAlias($this->dbFile);
            if (file_exists($dbFile)) {
                unlink($dbFile);
            }
        }

        $parts = $app->createController('migrate/up');

        if ($parts === false) {
            throw new Exception('Could not create controller');
        }

        /* @var $controller MigrateController */
        list($controller, $actionID) = $parts;

        $controller->interactive = false;
        $result = $controller->runAction($actionID, []);
        if ($result !== null && $result !== MigrateController::EXIT_CODE_NORMAL) {
            throw new Exception('Exit status was ' . VarDumper::dumpAsString($result));
        }
    }
}
