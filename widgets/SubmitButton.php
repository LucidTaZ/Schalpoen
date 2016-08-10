<?php

namespace app\widgets;

class SubmitButton extends \yii\base\Widget
{
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
        return $this->render('submit-button', [
            'icon' => $this->icon,
            'caption' => $this->caption,
        ]);
    }
}
