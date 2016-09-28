<?php

namespace tests\unit;

use LogicException;
use yii\base\BootstrapInterface;
use yii\base\Component;
use yii\base\Event;
use yii\db\BaseActiveRecord;

class ForbidDatabaseUsage extends Component implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $handler = function () {
            throw new LogicException('Using the database is forbidden in unit tests');
        };
        $eventNames = [
            BaseActiveRecord::EVENT_AFTER_FIND,
            BaseActiveRecord::EVENT_BEFORE_INSERT,
            BaseActiveRecord::EVENT_BEFORE_UPDATE,
            BaseActiveRecord::EVENT_BEFORE_DELETE,
        ];
        foreach ($eventNames as $eventName) {
            Event::on(BaseActiveRecord::class, $eventName, $handler);
        }
    }
}
