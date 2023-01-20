<?php

use yii\db\Migration;

/**
 * Class m230115_124525_create_fulltext_index_on_recipe
 */
class m230115_124525_create_fulltext_index_on_recipe extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("ALTER TABLE {{%recipe}} ADD FULLTEXT(name, description, tags)");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230115_124525_create_fulltext_index_on_recipe cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230115_124525_create_fulltext_index_on_recipe cannot be reverted.\n";

        return false;
    }
    */
}
