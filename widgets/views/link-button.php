<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $href string */
/* @var $icon string */
/* @var $caption string */

if (empty($icon)) {
    $iconElement = '';
} else {
    $iconElement = Html::tag('span', '', ['class' => ['glyphicon', 'glyphicon-' . $icon]]) . ' ';
}


?>
<?= Html::a($iconElement . Html::encode($caption), $href, ['class' => 'btn btn-default']) ?>
