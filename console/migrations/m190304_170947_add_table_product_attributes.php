<?php

use yii\db\Migration;

/**
 * Class m190304_170947_add_table_product_attributes
 */
class m190304_170947_add_table_product_attributes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('product_attributes', [
            'id' => $this->primaryKey(),
            'goods_id' => $this->integer()->notNull(),
            'attribute_id' => $this->integer()->notNull(),
            'value_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex('IDX_GOODS', 'product_attributes', 'goods_id');
        $this->createIndex('IDX_ATTRIBUTE', 'product_attributes', 'attribute_id');
        $this->createIndex('IDX_VALUE', 'product_attributes', 'value_id');

        $this->addForeignKey(
            'FC_GOODS',
            'product_attributes',
            'goods_id',
            'goods',
            'id'
        );

        $this->addForeignKey(
            'FC_ATTRIBUTE',
            'product_attributes',
            'attribute_id',
            'attribute',
            'id'
        );

        $this->addForeignKey(
            'FC_VALUE',
            'product_attributes',
            'value_id',
            'attribute_values',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FC_GOODS', 'product_attributes');
        $this->dropForeignKey('FC_ATTRIBUTE', 'product_attributes');
        $this->dropForeignKey('FC_VALUE', 'product_attributes');
        $this->dropTable('product_attributes');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190304_170947_add_table_product_attributes cannot be reverted.\n";

        return false;
    }
    */
}
