<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $icon string */
/* @var $caption string */

if (empty($icon)) {
    $iconElement = '';
} else {
    $iconElement = Html::tag('span', '', ['class' => ['glyphicon', 'glyphicon-' . $icon]]) . ' ';
}

?>
<?= Html::submitButton($iconElement . Html::encode($caption), ['class' => 'btn btn-default']) ?>
