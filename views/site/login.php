<?php

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model LoginForm */

use app\models\LoginForm;
use app\widgets\SubmitButton;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

$this->title = 'Inloggen';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contentPane">
    <h2><?= Html::encode($this->title) ?></h2>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "\n<div class=\"col-lg-5\">{label}<br />{input}\n{error}</div>",
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-5\">{input} {label} {error}</div>\n",
        ]) ?>

        <div class="form-group">
            <div class="col-lg-5">
                <?= SubmitButton::widget(['caption' => 'Inloggen', 'icon' => 'log-in']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    <p>
        Nog geen account? Registreren is heel makkelijk en kost slechts een paar
        seconden! <a href="<?= Url::toRoute(['site/register']) ?>">Klik hier!</a>
    </p>
</div>
