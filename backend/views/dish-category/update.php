<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\DishCategory $model */

$this->title = 'Update Dish Category: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Dish Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="dish-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
