<?php

use yii\data\ActiveDataProvider;
use yii\web\View;

/* @var $this View */
/* @var $recentPosts ActiveDataProvider */

$this->title = 'Het Schalpoen';
?>
<?= $this->render('@app/views/post/_list', [
    'dataProvider' => $recentPosts,
]) ?>
