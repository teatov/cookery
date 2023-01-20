<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Войти в учётную запись';
?>

<section>
    <div class="flex justify-center flex-column align-center fullscreen">
        <h1>Войти в учётную запись</h1>
        <?php $form = ActiveForm::begin(['id' => 'login-form', 'class' => 'form--login flex flex-column align-center']); ?>

        <div class="flex justify-center flex-column align-flex-start">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>
        </div>

        <?= Html::submitButton('Войти', ['class' => 'bg-yellow', 'name' => 'login-button']) ?>
        <?php ActiveForm::end(); ?>
    </div>
</section>