<?php

use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\ListView;

/* @var $this View */
/* @var $dataProvider ActiveDataProvider */

?>
<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_short-post',
    'layout' => "{items}\n{pager}",
    'emptyText' => 'Geen artikelen gevonden',
]) ?>
