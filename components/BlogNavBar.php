<?php

namespace app\components;

use yii\bootstrap\NavBar;
use yii\helpers\Html;

class BlogNavBar extends NavBar
{
    /**
     * @var string Custom selector to tell what the collapse button should
     * affect. This enables the collapse button to affect more than just the
     * navbar items, for example also the menu.
     */
    public $collapseSelector;

    public function init()
    {
        parent::init();
        if ($this->collapseSelector === null) {
            $this->collapseSelector = "#{$this->containerOptions['id']}"; // Retain original behavior
        }
    }

    protected function renderToggleButton()
    {
        $bar = Html::tag('span', '', ['class' => 'icon-bar']);
        $screenReader = "<span class=\"sr-only\">{$this->screenReaderToggleText}</span>";

        return Html::button("{$screenReader}\n{$bar}\n{$bar}\n{$bar}", [
            'class' => 'navbar-toggle',
            'data-toggle' => 'collapse',
            'data-target' => $this->collapseSelector,
        ]);
    }
}
