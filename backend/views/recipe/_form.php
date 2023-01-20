<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Ingredient;
use common\models\Step;

/** @var yii\web\View $this */
/** @var common\models\Recipe $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="recipe-form">

    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>
    <div class="flex justify-space-between flex-responsive">
        <div class="flex flex-column">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'dish_category')->textInput() ?>
            </select>
        </div>
        <div class="flex flex-column">
            <h3>
                <?php echo $model->getAttributeLabel('image') ?>:
            </h3>
            <input class="form-control" type="file" id="recipe-image" name="recipe-image" accept="image/*" />
        </div>
        <div class="flex flex-column flex-grow">
            <?= $form->field($model, 'description')->textarea(['rows' => 6, 'class' => 'flex-grow comment-text']) ?>
        </div>
    </div>

    <div class="flex flex-column">
                <?= $form->field($model, 'cooking_time')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'servings')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'difficulty')->textInput(['maxlength' => true]) ?>
            </div>

    <div class="list-narrow">
        <div class="flex justify-space-between flex-responsive">
            <div class="flex flex-column flex-grow">
                <fieldset class="flex flex-column flex-grow">
                    <legend>Ингредиенты
                        <?php
                        // new ingredient button
                        echo Html::a('Добавить', 'javascript:void(0);', [
                            'id' => 'new-ingredient-button',
                            'class' => 'btn bg-green'
                        ])
                            ?>
                    </legend>
                    <?php

                    // ingredient table
                    $ingredient = new Ingredient();
                    $ingredient->loadDefaultValues();
                    echo '<table id="ingredients" class="">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>' . $ingredient->getAttributeLabel('name') . '</th>';
                    echo '<th>' . $ingredient->getAttributeLabel('amount') . '</th>';
                    echo '<td>&nbsp;</td>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    // existing ingredients fields
                    foreach ($model->ingredients as $key => $_ingredient) {
                        echo '<tr>';
                        echo $this->render('_form_ingredient', [
                            'key' => $_ingredient->isNewRecord ? (strpos($key, 'new') !== false ? $key : 'new' . $key) : $_ingredient->id,
                            'form' => $form,
                            'ingredient' => $_ingredient,
                        ]);
                        echo '</tr>';
                    }

                    // new ingredient fields
                    echo '<tr id="new-ingredient-block" style="display: none;">';
                    echo $this->render('_form_ingredient', [
                        'key' => '__id__',
                        'form' => $form,
                        'ingredient' => $ingredient,
                    ]);
                    echo '</tr>';
                    echo '</tbody>';
                    echo '</table>';

                    ?>

                    <?php ob_start(); // output buffer the javascript to register later ?>
                    <script>

                        // add ingredient button
                        var ingredient_k = <?php echo isset($key) ? str_replace('new', '', $key) : 0; ?>;
                        $('#new-ingredient-button').on('click', function ()
                        {
                            ingredient_k += 1;
                            $('#ingredients').find('tbody')
                                .append('<tr>' + $('#new-ingredient-block').html().replace(/__id__/g, 'new' + ingredient_k) + '</tr>');
                        });

                        // remove ingredient button
                        $(document).on('click', '.remove-ingredient-button', function ()
                        {
                            $(this).closest('tbody tr').remove();
                        });

                    </script>
                    <?php $this->registerJs(str_replace(['<script>', '</script>'], '', ob_get_clean())); ?>

                </fieldset>
            </div>
            
        </div>
    </div>

    <div class="flex flex-column flex-grow">
    <fieldset>
        <legend>Шаги
            <?php
            // new step button
            echo Html::a('Добавить', 'javascript:void(0);', [
                'id' => 'new-step-button',
                'class' => 'btn bg-green'
            ])
                ?>
        </legend>
        <?php

        // step table
        $step = new Step();
        $step->loadDefaultValues();
        echo '<table id="steps" class="">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>' . $step->getAttributeLabel('image') . '</th>';
        echo '<th>' . $step->getAttributeLabel('text') . '</th>';
        echo '<td>&nbsp;</td>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

        // existing steps fields
        foreach ($model->steps as $key => $_step) {
            echo '<tr>';
            echo $this->render('_form_step', [
                'key' => $_step->isNewRecord ? (strpos($key, 'new') !== false ? $key : 'new' . $key) : $_step->id,
                'form' => $form,
                'step' => $_step,
            ]);
            echo '</tr>';
        }

        // new step fields
        echo '<tr id="new-step-block" style="display: none;">';
        echo $this->render('_form_step', [
            'key' => '__id__',
            'form' => $form,
            'step' => $step,
        ]);
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';

        ?>

        <?php ob_start(); // output buffer the javascript to register later ?>
        <script>

            // add step button
            var step_k = <?php echo isset($key) ? str_replace('new', '', $key) : 0; ?>;
            $('#new-step-button').on('click', function ()
            {
                step_k += 1;
                $('#steps').find('tbody')
                    .append('<tr>' + $('#new-step-block').html().replace(/__id__/g, 'new' + step_k) + '</tr>');
            });

            // remove step button
            $(document).on('click', '.remove-step-button', function ()
            {
                $(this).closest('tbody tr').remove();
            });

        </script>
        <?php $this->registerJs(str_replace(['<script>', '</script>'], '', ob_get_clean())); ?>

    </fieldset>
    </div>

    <div class="list-narrow">
    <?= $form->field($model, 'tags')->textInput(['maxlength' => true]) ?>
        <p>(через запятые)</p>
    </div>

    
    <div class="flex flex-column align-center">
        <?= $form->field($model, 'status')->dropDownList($model->getStatusLabels()) ?>
        <?= Html::submitButton('Сохранить', ['class' => 'bg-yellow publish']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<div class="divider"></div>