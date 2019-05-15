<?php

use yii\db\Migration;

class m190130_141245_update_table_verify_token extends Migration
{
    public function up()
    {
        $this->createTable('{{%verify_token}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'type' => $this->string(70)->notNull(),
            'token' => $this->string(),
            'expire_at' => $this->timestamp()->null(),
        ]);

        $this->createIndex('IDX_98E46A9BA76ED395', '{{%verify_token}}', 'user_id');
        $this->addForeignKey('FK_98E46A9BA76ED395', '{{%verify_token}}', 'user_id', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%verify_token}}');
    }
}
