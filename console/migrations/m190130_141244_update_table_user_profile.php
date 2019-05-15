<?php

use yii\db\Migration;

class m190130_141244_update_table_user_profile extends Migration
{
    public function up()
    {
        $this->createTable('{{%user_profile}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'first_name' => $this->string(70),
            'last_name' => $this->string(70),
            'avatar' => $this->string(70)->null(),
        ]);

        $this->createIndex('UNIQ_D95AB405A76ED395', '{{%user_profile}}', 'user_id', true);
        $this->addForeignKey('FK_D95AB405A76ED395', '{{%user_profile}}', 'user_id', '{{%user}}', 'id', 'RESTRICT', 'RESTRICT');
    }

    public function down()
    {
        $this->dropTable('{{%user_profile}}');
    }
}
