<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dish_category}}`.
 */
class m230115_060306_create_dish_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%dish_category}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(512)->notNull(),
            'parent_id'=>$this->integer(11),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%dish_category}}');
    }
}
