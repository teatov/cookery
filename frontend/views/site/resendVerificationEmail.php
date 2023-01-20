<?php

/** @var yii\web\View$this  */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ResetPasswordForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Переотправить письмо для подтверждения';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flex justify-center flex-column align-center fullscreen">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Письмо с ссылкой для подтверждения учётной записи придёт на почту.</p>

            <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form']); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'bg-yellow']) ?>
            </div>

            <?php ActiveForm::end(); ?>
</div>
