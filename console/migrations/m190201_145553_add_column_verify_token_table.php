<?php

use yii\db\Migration;

/**
 * Class m190201_145553_add_column_verify_token_table
 */
class m190201_145553_add_column_verify_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('verify_token', 'user_tmp_id', $this->integer()->null());
        $this->alterColumn('verify_token', 'user_id', $this->integer()->null());

        $this->createIndex('IDX_98E46A9BA76ED555', '{{%verify_token}}', 'user_tmp_id');
        $this->addForeignKey('FK_98E46A9BA76ED555', '{{%verify_token}}', 'user_tmp_id', '{{%user_tmp}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey('FK_98E46A9BA76ED555', 'verify_token');
        $this->dropIndex('IDX_98E46A9BA76ED555', 'verify_token');

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190201_145553_add_column_verify_token_table cannot be reverted.\n";

        return false;
    }
    */
}
