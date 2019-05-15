<?php

use yii\db\Migration;

class m190130_141238_update_table_attribute_group extends Migration
{
    public function up()
    {
        $this->createTable('{{%attribute_group}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(100)->notNull(),
            'description' => $this->text(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

    }

    public function down()
    {
        $this->dropTable('{{%attribute_group}}');
    }
}
