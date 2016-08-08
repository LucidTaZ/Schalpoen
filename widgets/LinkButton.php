<?php

namespace app\widgets;

class LinkButton extends \yii\base\Widget
{
    /**
     * @var string
     */
    public $href;

    /**
     * @var string
     */
    public $icon;

    /**
     * @var string
     */
    public $caption;

    public function run()
    {
        return $this->render('link-button', [
            'href' => $this->href,
            'icon' => $this->icon,
            'caption' => $this->caption,
        ]);
    }
}
