<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%recipe}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%dish_category}}`
 */
class m230115_060435_create_recipe_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%recipe}}', [
            // 'id' => $this->primaryKey(),
            'name' => $this->string(512)->notNull()->unique(),
            'slug' => $this->string(512)->notNull()->unique(),
            'description' => $this->text(),
            'created_by' => $this->integer(11),
            'dish_category' => $this->integer(11),
            'image' => $this->string(512),
            'cooking_time' => $this->string(32),
            'servings' => $this->string(32),
            'difficulty' => $this->string(32),
            'created_at' => $this->integer(11),
            'tags' => $this->string(512),
            'status' => $this->integer(1)
        ]);

        $this->addPrimaryKey('PK_recipe_slug', '{{%recipe}}', 'slug');

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-recipe-created_by}}',
            '{{%recipe}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-recipe-created_by}}',
            '{{%recipe}}',
            'created_by',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `dish_category`
        $this->createIndex(
            '{{%idx-recipe-dish_category}}',
            '{{%recipe}}',
            'dish_category'
        );

        // add foreign key for table `{{%dish_category}}`
        $this->addForeignKey(
            '{{%fk-recipe-dish_category}}',
            '{{%recipe}}',
            'dish_category',
            '{{%dish_category}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-recipe-created_by}}',
            '{{%recipe}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-recipe-created_by}}',
            '{{%recipe}}'
        );

        // drops foreign key for table `{{%dish_category}}`
        $this->dropForeignKey(
            '{{%fk-recipe-dish_category}}',
            '{{%recipe}}'
        );

        // drops index for column `dish_category`
        $this->dropIndex(
            '{{%idx-recipe-dish_category}}',
            '{{%recipe}}'
        );

        $this->dropTable('{{%recipe}}');
    }
}
