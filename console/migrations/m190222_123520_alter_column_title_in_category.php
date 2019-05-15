<?php

use yii\db\Migration;

/**
 * Class m190222_123520_alter_column_title_in_category
 */
class m190222_123520_alter_column_title_in_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('categories', 'title', $this->string(255)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190222_123520_alter_column_title_in_category cannot be reverted.\n";

        return false;
    }
    */
}
