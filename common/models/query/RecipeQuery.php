<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Recipe]].
 *
 * @see \common\models\Recipe
 */

 use common\models\Recipe;
class RecipeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Recipe[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Recipe|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function byUser($userId) {
        return $this->andWhere(['created_by' => $userId]);
    }

    public function latest() {
        return $this->orderBy(['created_at' => SORT_DESC]);
    }

    public function published() {
        return $this->andWhere(['status' => Recipe::STATUS_PUBLISHED]);
    }

    public function byKeyword($keyword)
    {
        return $this->andWhere("MATCH(name, description, tags)
        AGAINST (:keyword)", ['keyword' => $keyword]);
    }
}
