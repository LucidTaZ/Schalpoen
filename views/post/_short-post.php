<?php

use app\models\Post;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */
/* @var $model Post */

?>
<div class="shortPost contentPane">
    <div class="shortPostPreview">
        <?= Html::a(Html::img($model->absolutePreviewUrl), Url::toRoute($model->route)) ?>
    </div>

    <h3><?= Html::a($model->title, Url::toRoute($model->route)) ?></h3>

    <div class="shortPostText post">
        <p>
            Door: (Author)<br />
            <?= Yii::$app->formatter->asDatetime($model->published_at, 'short') ?>
        </p>

        <p>
            (First paragraph)
        </p>

        <p>
            (Read on button)
        </p>

        <p>
            (Tags)
        </p>
    </div>
</div>
