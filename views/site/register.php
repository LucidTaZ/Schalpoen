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

        <?= $form->field($model, 'answer')->textInput(['value' => ''])->label($model->question) ?>

        <div class="form-group">
            <div class="col-lg-5">
                <?= SubmitButton::widget(['caption' => 'Registreren', 'icon' => 'user']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>
</div>
