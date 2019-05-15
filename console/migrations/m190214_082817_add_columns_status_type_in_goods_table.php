<?php

use yii\db\Migration;

/**
 * Class m190214_082817_add_columns_status_type_in_goods_table
 */
class m190214_082817_add_columns_status_type_in_goods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('goods', 'status', $this->smallInteger()->notNull()->defaultValue(1));
        $this->addColumn('goods', 'type', $this->smallInteger()->notNull()->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('goods', 'status');
        $this->dropColumn('goods', 'type');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190214_082817_add_columns_status_type_in_goods_table cannot be reverted.\n";

        return false;
    }
    */
}
