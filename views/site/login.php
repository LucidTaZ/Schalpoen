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
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Vul je gegevens in om in te loggen:
    </p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-7\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-2 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= SubmitButton::widget(['caption' => 'Inloggen', 'icon' => 'log-in']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    <p>
        Nog geen account? Registreren is heel makkelijk en kost slechts een paar
        seconden! <a href="<?= Url::toRoute(['site/register']) ?>">Klik hier!</a>
    </p>
</div>
