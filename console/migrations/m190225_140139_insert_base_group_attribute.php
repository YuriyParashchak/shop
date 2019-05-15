<?php

use yii\db\Migration;

/**
 * Class m190225_140139_insert_base_group_attribute
 */
class m190225_140139_insert_base_group_attribute extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('attribute_group', [
            'title' => '{"en":"List","uk":"Список","ru":"Список"}',
            'description' => 'Drop down list'
        ]);
        $this->insert('attribute_group', [
            'title' => '{"en":"Digit","uk":"цифра","ru":"цифра"}',
            'description' => 'Digit data'
        ]);
        $this->insert('attribute_group', [
            'title' => '{"en":"Check box","uk":"Чек бокс","ru":"Чек бокс"}',
            'description' => 'Check box'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190225_140139_insert_base_group_attribute cannot be reverted.\n";

        return false;
    }
    */
}
