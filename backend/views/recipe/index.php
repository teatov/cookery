<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use common\models\Recipe;
use yii\helpers\StringHelper;

$this->title = 'Личный кабинет';
?>

<div class="flex flex-responsive">
    <div class="flex-grow">
        <h2>Собственные рецепты</h2>
        <?= GridView::widget([
            'dataProvider' => $recipeDataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'image',
                    'content' => function ($model) {
                                return Html::img($model->getImageLink(), ['style' => 'width: 5rem; max-height: 5rem']);
                            }
                ],
                [
                    'attribute' => 'name',
                    'content' => function ($model) {
                                return Html::a(Html::encode($model->name), ['view', 'slug' => $model->slug]);
                                // StringHelper::truncateWords('aaa', 10)
                            }
                ],
                [
                    'attribute' => 'description',
                    'content' => function ($model) {
                                return StringHelper::truncateWords($model->description, 20);
                            }
                ],
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Recipe $model, $key, $index, $column) {
                                return Url::toRoute([$action, 'slug' => $model->slug]);
                            },
                            'template' => '{update} {delete}',
                    'buttons' => [
                        'update' => function ($url) {
                            return Html::a('Редактировать', $url);
                        },
                        'delete' => function ($url) {
                                    return Html::a('Удалить', $url, [
                                        'data-method' => 'post',
                                        'data-confirm' => 'Вы уверены?'
                                    ]);
                                },
                    ]
                ],
            ],
        ]); ?>
        <a href="/recipe/create" class="btn bg-green">
            <span class="icon icon--plus"></span>Создать новый рецепт
        </a>
        <div class="divider"></div>
    </div>
    <div>
        <?php echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
        . Html::submitButton(
            'Выйти из учётной записи (' . Yii::$app->user->identity->username . ')',
            ['class' => 'bg-orange logout-btn']
        )
        . Html::endForm(); ?>
        <div class="divider"></div>
    </div>
</div>
<div class="divider"></div>