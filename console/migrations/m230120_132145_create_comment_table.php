<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%recipe}}`
 * - `{{%user}}`
 */
class m230120_132145_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'text' => $this->string(512)->notNull(),
            'created_at' => $this->integer(11),
            'recipe_slug' => $this->string(512),
            'created_by' => $this->integer(11),
        ]);

        // creates index for column `recipe_slug`
        $this->createIndex(
            '{{%idx-comment-recipe_slug}}',
            '{{%comment}}',
            'recipe_slug'
        );

        // add foreign key for table `{{%recipe}}`
        $this->addForeignKey(
            '{{%fk-comment-recipe_slug}}',
            '{{%comment}}',
            'recipe_slug',
            '{{%recipe}}',
            'slug',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-comment-created_by}}',
            '{{%comment}}',
            'created_by'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-comment-created_by}}',
            '{{%comment}}',
            'created_by',
            '{{%user}}',
            'id',
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
            '{{%fk-comment-recipe_slug}}',
            '{{%comment}}'
        );

        // drops index for column `recipe_slug`
        $this->dropIndex(
            '{{%idx-comment-recipe_slug}}',
            '{{%comment}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-comment-created_by}}',
            '{{%comment}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-comment-created_by}}',
            '{{%comment}}'
        );

        $this->dropTable('{{%comment}}');
    }
}
