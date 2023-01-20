<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ResetPasswordForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Новый пароль';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="flex justify-center flex-column align-center fullscreen">
    <h1>
        <?= Html::encode($this->title) ?>
    </h1>

    <p>Введите новый пароль:</p>

    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

    <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

    <?= Html::submitButton('Сохранить', ['class' => 'bg-green']) ?>

    <?php ActiveForm::end(); ?>
</div>