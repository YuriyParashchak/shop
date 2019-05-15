<?php

use yii\db\Migration;

/**
 * Class m190205_111351_change_table_category
 */
class m190205_111351_change_table_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropForeignKey('FK_3AF34668727ACA70', 'categories');
        $this->dropColumn('categories', 'parent_id');
        $this->dropColumn('categories', 'created');
        $this->dropColumn('categories', 'updated');
        $this->alterColumn('categories', 'root', $this->integer()->notNull());
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
        echo "m190205_111351_change_table_category cannot be reverted.\n";

        return false;
    }
    */
}
