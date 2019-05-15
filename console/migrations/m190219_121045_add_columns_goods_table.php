<?php

use yii\db\Migration;

/**
 * Class m190219_121045_add_columns_goods_table
 */
class m190219_121045_add_columns_goods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('goods', 'views', $this->integer()->null());
        $this->addColumn('goods', 'likes', $this->integer()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('goods', 'views');
        $this->dropColumn('goods', 'likes');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190219_121045_add_columns_goods_table cannot be reverted.\n";

        return false;
    }
    */
}
