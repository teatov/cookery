<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Recipe $model */

$this->title = 'Редактирование рецепта: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Рецепты', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'slug' => $model->slug]];
$this->params['breadcrumbs'][] = 'Редактировать';
?>
<div class="recipe-update">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
