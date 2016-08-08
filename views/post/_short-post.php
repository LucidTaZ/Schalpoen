<?php

use app\models\Post;
use app\models\Tag;
use app\widgets\LinkButton;
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

    <h3><?= Html::a(Html::encode($model->title), Url::toRoute($model->route)) ?></h3>

    <div class="shortPostText post">
        <p>
            Door: <?= Html::a(Html::encode($model->author->displayName), Url::toRoute($model->author->route)) ?><br />
            <?= Yii::$app->formatter->asDatetime($model->published_at, 'short') ?>
        </p>

        <p>
            <?= Html::encode($model->firstParagraph) ?>
        </p>

        <p>
            <?= LinkButton::widget([
                'href' => Url::toRoute($model->route),
                'icon' => 'book',
                'caption' => 'Lees verder',
            ]) ?>
        </p>

        <p>
            <?= implode(', ', array_map(function (Tag $tag) {
                    return Html::a(Html::encode($tag->title), Url::toRoute($tag->route));
                }, $model->tags)) ?>
        </p>
    </div>
</div>
