<?php

use yii\db\Migration;

/**
 * Class m190207_115446_add_imgUrl_goods_table
 */
class m190207_115446_add_imgUrl_goods_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('goods', 'img', $this->json()->comment('(DC2Type:json_array)'));
        $this->addColumn('goods', 'created', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('goods', 'img');
        $this->dropColumn('goods', 'created');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190207_115446_add_imgUrl_goods_table cannot be reverted.\n";

        return false;
    }
    */
}
