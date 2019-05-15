<?php

use yii\db\Migration;

/**
 * Class m190217_154152_add_table_currency
 */
class m190217_154152_add_table_currency extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('currency',[
            'id' => $this->primaryKey(),
            'title' => $this->string(20)->notNull(),
            'name' => $this->string(40)->notNull(),
            'classes' => $this->string(255)->null(),
        ]);

        $this->addColumn('goods', 'currency_id', $this->integer()->null());
        $this->createIndex('IDX_CURRENCY', 'goods', 'currency_id');
        $this->addForeignKey('FK_CURRENCY',
            'goods',
            'currency_id',
            'currency',
            'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_CURRENCY', 'goods');
        $this->dropIndex('IDX_CURRENCY', 'goods');
        $this->dropColumn('goods', 'currency_id');
        $this->dropTable('currency');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190217_154152_add_table_currency cannot be reverted.\n";

        return false;
    }
    */
}
