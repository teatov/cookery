<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%ingredient}}".
 *
 * @property int $id
 * @property string $name
 * @property string $amount
 * @property string|null $recipe_slug
 *
 * @property Recipe $recipeSlug
 */
class Ingredient extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ingredient}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'amount'], 'required'],
            [['name'], 'string', 'max' => 128],
            [['amount'], 'string', 'max' => 32],
            [['recipe_slug'], 'string', 'max' => 512],
            [['recipe_slug'], 'exist', 'skipOnError' => true, 'targetClass' => Recipe::class, 'targetAttribute' => ['recipe_slug' => 'slug']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'amount' => 'Количество',
            'recipe_slug' => 'Recipe Slug',
        ];
    }

    /**
     * Gets query for [[RecipeSlug]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\RecipeQuery
     */
    public function getRecipeSlug()
    {
        return $this->hasOne(Recipe::class, ['slug' => 'recipe_slug']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\IngredientQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\IngredientQuery(get_called_class());
    }
}
