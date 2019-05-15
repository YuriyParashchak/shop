<?php

use yii\db\Migration;

class m190130_141239_update_table_attribute extends Migration
{
    public function up()
    {
        $this->createTable('{{%attribute}}', [
            'id' => $this->primaryKey(),
            'attribute_group_id' => $this->integer()->notNull(),
            'title' => $this->string(70)->notNull(),
            'slug'  => $this->string(70)->notNull(),
            'type' => $this->string(50)->notNull(),
            'required' => $this->tinyInteger()->notNull(),
            'variants' => $this->json()->comment('(DC2Type:json_array)'),
            'sort' => $this->integer()->notNull(),
        ]);

        $this->createIndex('IDX_FA7AEFFB62D643B7', '{{%attribute}}', 'attribute_group_id');
        $this->addForeignKey('FK_FA7AEFFB62D643B7', '{{%attribute}}', 'attribute_group_id', '{{%attribute_group}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%attribute}}');
    }
}
