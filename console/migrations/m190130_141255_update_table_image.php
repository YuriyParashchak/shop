<?php

use yii\db\Migration;

class m190130_141255_update_table_image extends Migration
{
    public function up()
    {
        $this->createTable('{{%image}}', [
            'id' => $this->primaryKey(),
            'file' => $this->string(70)->notNull(),
            'slug' => $this->string(70)->notNull(),
            'goods_id' => $this->integer(),
            'reverse' => $this->smallInteger()->notNull(),
        ]);

        $this->createIndex('IDX_C53D045FB7683595', '{{%image}}', 'goods_id');
        $this->addForeignKey('FK_C53D045FB7683595', '{{%image}}', 'goods_id', '{{%goods}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%image}}');
    }
}
