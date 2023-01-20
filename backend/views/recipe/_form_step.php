<?php
use common\models\Step;
use yii\helpers\Html;

?>
<td>
    <?= $form->field($step, 'image')->fileInput([
        'id' => "Steps_{$key}_image",
        'name' => "Steps[$key][image]",
        'accept' => 'image/*'
    ])->label(false) ?>
</td>
<td>
    <?= $form->field($step, 'text')->textInput([
        'id' => "Steps_{$key}_text",
        'name' => "Steps[$key][text]",
    ])->label(false) ?>
</td>
<td>
    <?= Html::a('Удалить', 'javascript:void(0);', [
        'class' => 'remove-step-button btn bg-orange',
    ]) ?>
</td>