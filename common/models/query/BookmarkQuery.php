<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Bookmark]].
 *
 * @see \common\models\Bookmark
 */
class BookmarkQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Bookmark[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Bookmark|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function userIdRecipeSlug($userId, $recipeSlug) {
        return $this->andWhere([
            'recipe_slug' => $recipeSlug,
            'user_id' => $userId
        ])->one();
    }
}
