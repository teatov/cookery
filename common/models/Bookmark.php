<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%bookmark}}".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $recipe_slug
 *
 * @property Recipe $recipeSlug
 * @property User $user
 */
class Bookmark extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%bookmark}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['recipe_slug'], 'string', 'max' => 512],
            [['recipe_slug'], 'exist', 'skipOnError' => true, 'targetClass' => Recipe::class, 'targetAttribute' => ['recipe_slug' => 'slug']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\BookmarkQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\BookmarkQuery(get_called_class());
    }
}
