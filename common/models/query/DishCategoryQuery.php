<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\DishCategory]].
 *
 * @see \common\models\DishCategory
 */
class DishCategoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\DishCategory[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\DishCategory|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
