<?php

use app\models\RegistrationForm;
use app\widgets\SubmitButton;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model RegistrationForm */

$this->title = 'Registreren';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-register contentPane">
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

        <?= $form->field($model, 'answer')->textInput(['value' => ''])->label($model->question) ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= SubmitButton::widget(['caption' => 'Registreren', 'icon' => 'log-in']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
