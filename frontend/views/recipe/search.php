<?php
/** @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = 'Поиск';
?>
<h1>Вот что мы нашли</h1>
<?php echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_recipe_item',
    'layout' => '<ul>{items}</ul>{pager}',
    'itemOptions' => [
        'tag' => 'li'
    ]
]) ?>