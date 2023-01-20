<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\DishCategory $model */

$this->title = 'Create Dish Category';
$this->params['breadcrumbs'][] = ['label' => 'Dish Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dish-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
