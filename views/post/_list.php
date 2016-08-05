<?php

use yii\data\ActiveDataProvider;
use yii\web\View;

/* @var $this View */
/* @var $dataProvider ActiveDataProvider */

?>
<?php foreach ($dataProvider->models as $model): ?>
    <?= $this->render('_short-post', [
        'model' => $model,
    ]) ?>
<?php endforeach; ?>
