<?php

use yii\db\Migration;

/**
 * Class m190205_112436_change_table_category_delete_root
 */
class m190205_112436_change_table_category_delete_root extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn('categories', 'root');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190205_112436_change_table_category_delete_root cannot be reverted.\n";

        return false;
    }
    */
}
