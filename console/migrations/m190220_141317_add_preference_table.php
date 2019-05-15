<?php

use yii\db\Migration;

/**
 * Class m190220_141317_add_preference_table
 */
class m190220_141317_add_preference_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('preference',[
            'id' => $this->primaryKey(),
            'product_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex('IDX_pref_product', 'preference', 'product_id');
        $this->createIndex('IDX_pref_user', 'preference', 'user_id');
        $this->addForeignKey('FK_pref_product',
            'preference',
            'product_id',
            'goods',
            'id');
        $this->addForeignKey('FK_pref_user',
            'preference',
            'user_id',
            'user',
            'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('IDX_pref_product', 'preference');
        $this->dropIndex('IDX_pref_user', 'preference');
        $this->dropForeignKey('FK_pref_product','preference');
        $this->dropForeignKey('FK_pref_user','preference');
        $this->dropTable('preference');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190220_141317_add_preference_table cannot be reverted.\n";

        return false;
    }
    */
}
