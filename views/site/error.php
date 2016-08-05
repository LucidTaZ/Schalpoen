<?php

use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        <img src="http://static.schalpoen.nl/style/404.jpg" />
    </p>

</div>
