<?php

namespace tests\unit;

use yii\web\View;

class TestCase extends \yii\codeception\TestCase
{
    public $appConfig = '@tests/config/unit.php';

    /**
     * Create a view and render it
     * Only call this method if your child class implements ViewContextInterface
     * @param string $template
     * @param array $params
     * @return string
     */
    protected function render(string $template, array $params = []): string
    {
        $view = new View;
        return $view->render($template, $params, $this);
    }
}
