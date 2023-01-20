<?php
use yii\bootstrap5\Nav;

?>

<?php echo Nav::widget([
  'options' => [
    'class' => 'd-flex flex-column nav-pills'
  ],
  'items' => [
    [
      'label' => 'Dashboard',
      'url' => '/site/index'
    ],
    [
      'label' => 'Recipes',
      'url' => '/recipe/index'
    ]
  ]
]) ?>