<?php

use yii\db\Migration;

class m190130_141243_update_table_user_phones extends Migration
{
    public function up()
    {
        $this->createTable('{{%user_phones}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'phone' => $this->string(30)->notNull(),
            'status' => $this->string(20)->notNull(),
        ]);

        $this->createIndex('IDX_867A35C8A76ED395', '{{%user_phones}}', 'user_id');

        $this->addForeignKey('FK_867A35C8A76ED395', '{{%user_phones}}', 'user_id', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');

    }

    public function down()
    {
        $this->dropTable('{{%user_phones}}');
    }
}
