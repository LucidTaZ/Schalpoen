<?php

use app\assets\AppAsset;
use app\components\BlogNavBar;
use app\widgets\Menu;
use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */
/* @var $content string */

AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="shortcut icon" href="<?= Html::encode(Yii::$app->params['favicon_uri']) ?>" />
    <link rel="alternate" type="application/rss+xml" href="/rss" />
    <?php if (isset($this->params['description'])): ?>
        <meta name="description" content="<?= Html::encode(str_replace('"', '', $this->params['description'])) ?>" />
    <?php endif; ?>
    <?php if (isset($this->params['keywords'])): ?>
        <meta name="keywords" content="<?= implode(', ', array_map([Html::class, 'encode'], $this->params['keywords'])) ?>" />
    <?php endif; ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    BlogNavBar::begin([
        'brandLabel' => 'Het Schalpoen',
        'brandUrl' => Url::home(),
        'options' => [
            'class' => 'navbar-inverse navbar-static-top',
        ],
        'collapseSelector' => '.collapse', // Collapse both the navbar and the menu
    ]);
    if (Yii::$app->user->isGuest) {
        $items = [
            ['label' => 'Inloggen', 'url' => ['/site/login']],
            ['label' => 'Registreren', 'url' => ['/site/register']],
        ];
    } else {
        $items = [
            '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Uitloggen (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link']
            )
            . Html::endForm()
            . '</li>'
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items,
    ]);
    BlogNavBar::end();
    ?>

    <div class="page-container">
        <div id="menu" class="contentPane collapse">
            <?= Menu::widget() ?>
        </div>
        <div id="content">
            <?= $content ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Thijs Zumbrink 2010-<?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
