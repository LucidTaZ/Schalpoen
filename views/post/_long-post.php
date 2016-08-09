<?php

use app\models\Post;
use app\models\Tag;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */
/* @var $model Post */

?>
<div class="longPost contentPane">
    <div class="longPostPreview">
        <?= Html::a(Html::img($model->absolutePreviewUrl), Url::toRoute($model->route)) ?>
    </div>

    <h2><?= Html::a(Html::encode($model->title), Url::toRoute($model->route)) ?></h2>

    <div class="longPostText post">
        <p>
            Door: <?= Html::a(Html::encode($model->author->displayName), Url::toRoute($model->author->route)) ?><br />
            <?= Yii::$app->formatter->asDatetime($model->published_at, 'short') ?>
        </p>

        <p>
            <?= $model->parsedText ?>
        </p>

        <hr />

        <p>
            <?= implode(', ', array_map(function (Tag $tag) {
                return Html::a(Html::encode($tag->title), Url::toRoute($tag->route));
            }, $model->tags)) ?>
        </p>
    </div>
</div>
