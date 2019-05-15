<?php

use yii\db\Migration;

class m190130_141250_update_table_goods extends Migration
{
    public function up()
    {
        $this->createTable('{{%goods}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'category_id' => $this->integer()->notNull(),
            'title' => $this->string(70)->notNull(),
            'slug'  => $this->string(70)->notNull(),
            'description' => $this->text()->notNull(),
            'price' => $this->double(2)->notNull(),
        ]);

        $this->createIndex('IDX_563B92DA76ED395', '{{%goods}}', 'user_id');
        $this->createIndex('IDX_563B92D12469DE2', '{{%goods}}', 'category_id');
        $this->addForeignKey('FK_563B92D12469DE2', '{{%goods}}', 'category_id', '{{%categories}}', 'id', 'RESTRICT', 'RESTRICT');
        $this->addForeignKey('FK_563B92DA76ED395', '{{%goods}}', 'user_id', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%goods}}');
    }
}
