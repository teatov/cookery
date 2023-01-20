<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bookmark}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%recipe}}`
 */
class m230115_111343_create_bookmark_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bookmark}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11),
            'recipe_slug' => $this->string(512),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-bookmark-user_id}}',
            '{{%bookmark}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-bookmark-user_id}}',
            '{{%bookmark}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `recipe_slug`
        $this->createIndex(
            '{{%idx-bookmark-recipe_slug}}',
            '{{%bookmark}}',
            'recipe_slug'
        );

        // add foreign key for table `{{%recipe}}`
        $this->addForeignKey(
            '{{%fk-bookmark-recipe_slug}}',
            '{{%bookmark}}',
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
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-bookmark-user_id}}',
            '{{%bookmark}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-bookmark-user_id}}',
            '{{%bookmark}}'
        );

        // drops foreign key for table `{{%recipe}}`
        $this->dropForeignKey(
            '{{%fk-bookmark-recipe_slug}}',
            '{{%bookmark}}'
        );

        // drops index for column `recipe_slug`
        $this->dropIndex(
            '{{%idx-bookmark-recipe_slug}}',
            '{{%bookmark}}'
        );

        $this->dropTable('{{%bookmark}}');
    }
}
