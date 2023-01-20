<?php
use common\models\Ingredient;
use yii\helpers\Html;
?>
<td>
    <?= $form->field($ingredient, 'name')->textInput([
        'id' => "Ingredients_{$key}_name",
        'name' => "Ingredients[$key][name]",
    ])->label(false) ?>
</td>
<td>
    <?= $form->field($ingredient, 'amount')->textInput([
        'id' => "Ingredients_{$key}_amount",
        'name' => "Ingredients[$key][amount]",
    ])->label(false) ?>
</td>
<td>
    <?= Html::a('Удалить', 'javascript:void(0);', [
      'class' => 'remove-ingredient-button btn bg-orange',
    ]) ?>
</td>
