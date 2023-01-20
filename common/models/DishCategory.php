<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%dish_category}}".
 *
 * @property int $id
 * @property string $name
 * @property int|null $parent_id
 *
 * @property Recipe[] $recipes
 */
class DishCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%dish_category}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent_id'], 'integer'],
            [['name'], 'string', 'max' => 512],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'parent_id' => 'Parent ID',
        ];
    }

    /**
     * Gets query for [[Recipes]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\RecipeQuery
     */
    public function getRecipes()
    {
        return $this->hasMany(Recipe::class, ['dish_category' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\DishCategoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\DishCategoryQuery(get_called_class());
    }
}
