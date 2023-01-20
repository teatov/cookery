<?php
use yii\widgets\ListView;

/**
 * @var $dataProvider \yii\data\ActiveDataProvider
 */

$this->title = Yii::$app->name;
?>

<div class="flex flex-column align-center">
    <h1>COOKERY</h1>
    <h2>Рецепты приготовления блюд с фото</h2>
    <p>Кулинарная книга с возможностью создания собственных рецептов</p>
</div>
<div class="divider"></div>
<h2>Новые рецепты:</h2>
<?php echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_recipe_item',
    'itemOptions' => [
        'tag' => 'li'
    ],
    'layout' => '<ul>{items}</ul>{pager}'
]) ?>
<div class="divider"></div>