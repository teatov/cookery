<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%step}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%recipe}}`
 */
class m230115_064605_create_step_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%step}}', [
            'id' => $this->primaryKey(),
            'text' => $this->string(512)->notNull(),
            'image' => $this->string(512),
            'recipe_slug' => $this->string(512),
        ]);

        // creates index for column `recipe_slug`
        $this->createIndex(
            '{{%idx-step-recipe_slug}}',
            '{{%step}}',
            'recipe_slug'
        );

        // add foreign key for table `{{%recipe}}`
        $this->addForeignKey(
            '{{%fk-step-recipe_slug}}',
            '{{%step}}',
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
            '{{%fk-step-recipe_slug}}',
            '{{%step}}'
        );

        // drops index for column `recipe_slug`
        $this->dropIndex(
            '{{%idx-step-recipe_slug}}',
            '{{%step}}'
        );

        $this->dropTable('{{%step}}');
    }
}
