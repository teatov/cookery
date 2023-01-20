<?php
use yii\helpers\StringHelper;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * @var $model \common\models\Recipe
 */

?>

<div class="flex justify-space-between flex-responsive">
    <?php if ($model->getImageLink()): ?>
        <img class="recipe-card-image modal-image" crossorigin="anonymous" src="<?php echo $model->getImageLink() ?>"
            alt="" />
    <?php endif; ?>
    <div class="card flex flex-column justify-space-between align-stretch flex-grow">
        <div>
            <h2><a href="<?php echo Url::to(['recipe/view', 'slug' => $model->slug]) ?>">
                    <?= Html::encode($model->name) ?>
                </a></h2>
            <p>
            <?= Html::encode(StringHelper::truncateWords($model->description, 40)) ?>
            </p>
            <div class="flex align-center">
                <div class="flex align-center">
                    <span class="icon icon--time"></span>
                </div>
                <h3>
                    <?= Html::encode($model->cooking_time) ?>
                </h3>
                <div class="flex align-center">
                    <span class="icon icon--serving"></span>
                </div>
                <h3>
                    <?= Html::encode($model->servings) ?>
                </h3>
                <div class="flex align-center">
                    <span class="icon icon--difficulty"></span>
                </div>
                <h3>
                    <?= Html::encode($model->difficulty) ?>
                </h3>
            </div>
        </div>
    </div>
</div>