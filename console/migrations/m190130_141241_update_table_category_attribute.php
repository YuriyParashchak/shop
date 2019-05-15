<?php

use yii\db\Migration;

class m190130_141241_update_table_category_attribute extends Migration
{
    public function up()
    {
        $this->createTable('{{%category_attribute}}', [
            'category_id' => $this->integer()->notNull(),
            'attribute_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('PRIMARYKEY', '{{%category_attribute}}', ['category_id', 'attribute_id']);
        $this->createIndex('IDX_3D1A3DCBB6E62EFA', '{{%category_attribute}}', 'attribute_id');
        $this->createIndex('IDX_3D1A3DCB12469DE2', '{{%category_attribute}}', 'category_id');
        $this->addForeignKey('FK_3D1A3DCB12469DE2', '{{%category_attribute}}', 'category_id', '{{%categories}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('FK_3D1A3DCBB6E62EFA', '{{%category_attribute}}', 'attribute_id', '{{%attribute}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%category_attribute}}');
    }
}
