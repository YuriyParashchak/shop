<?php

use yii\db\Migration;

class m190130_141236_update_table_categories extends Migration
{
    public function up()
    {
        $this->createTable('{{%categories}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'title' => $this->string(100)->notNull(),
            'description' => $this->text(),
            'slug' => $this->string(100)->notNull(),
            'lft' => $this->integer()->notNull(),
            'rgt' => $this->integer()->notNull(),
            'root' => $this->integer(),
            'lvl' => $this->integer()->notNull(),
            'created' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('UNIQ_3AF346682B36786B', '{{%categories}}', 'title', true);
        $this->createIndex('IDX_3AF34668727ACA70', '{{%categories}}', 'parent_id');
        $this->addForeignKey('FK_3AF34668727ACA70', '{{%categories}}', 'parent_id', '{{%categories}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%categories}}');
    }
}
