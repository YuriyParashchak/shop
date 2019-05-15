<?php

use yii\db\Migration;

/**
 * Class m190222_162913_alter_column_title_in_attribute
 */
class m190222_162913_alter_column_title_in_attribute extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('attribute', 'title', $this->string(255)->notNull());
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
        echo "m190222_162913_alter_column_title_in_attribute cannot be reverted.\n";

        return false;
    }
    */
}
