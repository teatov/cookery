<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Создать учётную запись';
$this->params['breadcrumbs'][] = $this->title;
?>

<section>
    <div class="flex justify-center flex-column align-center fullscreen">
        <h1>Создать учётную запись</h1>
        <?php $form = ActiveForm::begin(['id' => 'form-signup', 'class' => 'form--signup flex flex-column align-center']); ?>
        <div class="flex justify-center flex-column align-flex-start">
            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'email') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>
        </div>
        <?= Html::submitButton('Создать', ['class' => 'bg-green', 'name' => 'signup-button']) ?>
        <?php ActiveForm::end(); ?>
        <p>Уже есть учётная запись? <a href="/site/login">Войдите!</a></p>
    </div>
</section>