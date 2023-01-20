<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ingredient}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%recipe}}`
 */
class m230115_064445_create_ingredient_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ingredient}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(128)->notNull(),
            'amount' => $this->string(32)->notNull(),
            'recipe_slug' => $this->string(512),
        ]);

        // creates index for column `recipe_slug`
        $this->createIndex(
            '{{%idx-ingredient-recipe_slug}}',
            '{{%ingredient}}',
            'recipe_slug'
        );

        // add foreign key for table `{{%recipe}}`
        $this->addForeignKey(
            '{{%fk-ingredient-recipe_slug}}',
            '{{%ingredient}}',
            'recipe_slug',
            '{{%recipe}}',
            'slug',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%recipe}}`
        $this->dropForeignKey(
            '{{%fk-ingredient-recipe_slug}}',
            '{{%ingredient}}'
        );

        // drops index for column `recipe_slug`
        $this->dropIndex(
            '{{%idx-ingredient-recipe_slug}}',
            '{{%ingredient}}'
        );

        $this->dropTable('{{%ingredient}}');
    }
}
