<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Recipe $model */
/** @var yii\widgets\ActiveForm $form */

$this->title = 'Новый рецепт';
$this->params['breadcrumbs'][] = ['label' => 'Рецепты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipe-create flex justify-center flex-column align-center fullscreen">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="recipe-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'bg-green']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

</div>
