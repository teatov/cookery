<?php
namespace backend\models;

use common\models\Recipe;
use common\models\Ingredient;
use common\models\Step;
use Yii;
use yii\base\Model;
use yii\widgets\ActiveForm;

class RecipeForm extends Model
{
    private $_recipe;
    private $_ingredients;
    private $_steps;

    public function rules()
    {
        return [
            [['Recipe'], 'required'],
            [['Ingredients'], 'safe'],
            [['Steps'], 'safe'],
        ];
    }

    public function afterValidate()
    {
        if (!Model::validateMultiple($this->getAllModels())) {
            $this->addError(null); // add an empty error to prevent saving
        }
        parent::afterValidate();
    }

    public function save()
    {
        if (!$this->validate()) {
            return false;
        }
        $transaction = Yii::$app->db->beginTransaction();
        if (!$this->recipe->save()) {
            $transaction->rollBack();
            return false;
        }
        if (!$this->saveIngredients()) {
            $transaction->rollBack();
            return false;
        }
        if (!$this->saveSteps()) {
            $transaction->rollBack();
            return false;
        }
        $transaction->commit();
        return true;
    }
    
    public function saveIngredients() 
    {
        $keep = [];
        foreach ($this->ingredients as $ingredient) {
            $ingredient->recipe_slug = $this->recipe->slug;
            if (!$ingredient->save(false)) {
                return false;
            }
            $keep[] = $ingredient->id;
        }
        $query = Ingredient::find()->andWhere(['recipe_slug' => $this->recipe->slug]);
        if ($keep) {
            $query->andWhere(['not in', 'id', $keep]);
        }
        foreach ($query->all() as $ingredient) {
            $ingredient->delete();
        }        
        return true;
    }

    public function saveSteps() 
    {
        $keep = [];
        foreach ($this->steps as $step) {
            $step->recipe_slug = $this->recipe->slug;
            if (!$step->save(false)) {
                return false;
            }
            $keep[] = $step->id;
        }
        $query = Step::find()->andWhere(['recipe_slug' => $this->recipe->slug]);
        if ($keep) {
            $query->andWhere(['not in', 'id', $keep]);
        }
        foreach ($query->all() as $step) {
            $step->delete();
        }        
        return true;
    }

    public function getRecipe()
    {
        return $this->_recipe;
    }

    public function setRecipe($recipe)
    {
        if ($recipe instanceof Recipe) {
            $this->_recipe = $recipe;
        } else if (is_array($recipe)) {
            $this->_recipe->setAttributes($recipe);
        }
    }

    public function getIngredients()
    {
        if ($this->_ingredients === null) {
            $this->_ingredients = $this->recipe->isNewRecord ? [] : $this->recipe->ingredients;
        }
        return $this->_ingredients;
    }

    public function getSteps()
    {
        if ($this->_steps === null) {
            $this->_steps = $this->recipe->isNewRecord ? [] : $this->recipe->steps;
        }
        return $this->_steps;
    }

    private function getIngredient($key)
    {
        $ingredient = $key && strpos($key, 'new') === false ? Ingredient::findOne($key) : false;
        if (!$ingredient) {
            $ingredient = new Ingredient();
            $ingredient->loadDefaultValues();
        }
        return $ingredient;
    }

    private function getStep($key)
    {
        $step = $key && strpos($key, 'new') === false ? Step::findOne($key) : false;
        if (!$step) {
            $step = new Step();
            $step->loadDefaultValues();
        }
        return $step;
    }

    public function setIngredients($ingredients)
    {
        unset($ingredients['__id__']); // remove the hidden "new Ingredient" row
        $this->_ingredients = [];
        foreach ($ingredients as $key => $ingredient) {
            if (is_array($ingredient)) {
                $this->_ingredients[$key] = $this->getIngredient($key);
                $this->_ingredients[$key]->setAttributes($ingredient);
            } elseif ($ingredient instanceof Ingredient) {
                $this->_ingredients[$ingredient->id] = $ingredient;
            }
        }
    }

    public function setSteps($steps)
    {
        unset($steps['__id__']); // remove the hidden "new Step" row
        $this->_steps = [];
        foreach ($steps as $key => $step) {
            if (is_array($step)) {
                $this->_steps[$key] = $this->getStep($key);
                $this->_steps[$key]->setAttributes($step);
            } elseif ($step instanceof Step) {
                $this->_steps[$step->id] = $step;
            }
        }
    }

    public function errorSummary($form)
    {
        $errorLists = [];
        foreach ($this->getAllModels() as $id => $model) {
            $errorList = $form->errorSummary($model, [
              'header' => '<p>Please fix the following errors for <b>' . $id . '</b></p>',
            ]);
            $errorList = str_replace('<li></li>', '', $errorList); // remove the empty error
            $errorLists[] = $errorList;
        }
        return implode('', $errorLists);
    }

    private function getAllModels()
    {
        $models = [
            'Recipe' => $this->recipe,
        ];
        foreach ($this->ingredients as $id => $ingredient) {
            $models['Ingredient.' . $id] = $this->ingredients[$id];
        }
        foreach ($this->steps as $id => $step) {
            $models['Step.' . $id] = $this->steps[$id];
        }
        return $models;
    }
}
