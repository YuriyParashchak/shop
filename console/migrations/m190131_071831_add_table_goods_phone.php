<?php

use yii\db\Migration;

/**
 * Class m190131_071831_add_table_goods_phone
 */
class m190131_071831_add_table_goods_phone extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('goods_phone',[
            'id' => $this->primaryKey(),
            'goods_id' => $this->integer()->notNull(),
            'phone_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex('IDX_goods', 'goods_phone', 'goods_id');
        $this->createIndex('IDX_phone', 'goods_phone', 'phone_id');
        $this->addForeignKey('FK_goods',
            'goods_phone',
            'goods_id',
            'goods',
            'id');
        $this->addForeignKey('FK_phone',
            'goods_phone',
            'phone_id',
            'user_phones',
            'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('IDX_goods', 'goods_phone');
        $this->dropIndex('IDX_phone', 'goods_phone');
        $this->dropForeignKey('FK_goods', 'goods_phone');
        $this->dropForeignKey('FK_phone', 'goods_phone');
        $this->dropTable('goods_phone');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190131_071831_add_table_goods_phone cannot be reverted.\n";

        return false;
    }
    */
}
