<?php

use yii\db\Migration;

/**
 * Class m190219_114812_table_product_view
 */
class m190219_114812_table_product_view extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product_hit', [
            'id' => $this->primaryKey(),
            'event_type' => $this->smallInteger()->notNull()->comment('1-view, 2-like'),
            'goods_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->null(),
            'ip_address' => $this->string(30)->notNull(),
            'click_date' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->createIndex('IDX_product_hit_goods', 'product_hit', 'goods_id');
        $this->addForeignKey('FK_product_hit_goods',
            'product_hit',
            'goods_id',
            'goods',
            'id');
        $this->createIndex('IDX_product_hit_user', 'product_hit', 'user_id');
        $this->addForeignKey('FK_product_hit_user',
            'product_hit',
            'user_id',
            'user',
            'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_product_hit_goods', 'product_hit');
        $this->dropIndex('IDX_product_hit_goods', 'product_hit');
        $this->dropForeignKey('FK_product_hit_user', 'product_hit');
        $this->dropIndex('IDX_product_hit_user', 'product_hit');
        $this->dropTable('product_hit');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190219_114812_table_product_view cannot be reverted.\n";

        return false;
    }
    */
}
