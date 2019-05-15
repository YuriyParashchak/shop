<?php

use yii\db\Migration;

/**
 * Class m190205_114228_change_table_category_insert_root_category
 */
class m190205_114228_change_table_category_insert_root_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('{{%categories}}', [
            'id' => 1,
            'slug' => 'root',
            'title' => 'root',
            'description' => null,
            'lft' => 1,
            'rgt' => 2,
            'lvl' => 0,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190205_114228_change_table_category_insert_root_category cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190205_114228_change_table_category_insert_root_category cannot be reverted.\n";

        return false;
    }
    */
}
