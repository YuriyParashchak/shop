<?php

use yii\db\Migration;

/**
 * Class m190201_144414_add_table_user_tmp
 */
class m190201_144414_add_table_user_tmp extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_tmp', [
            'id' => $this->primaryKey(),
            'username' => $this->string(70)->notNull(),
            'email' => $this->string(70)->notNull()->unique(),
            'phone' => $this->string(30)->null(),
            'password' => $this->string('50')->notNull(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user_tmp');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190201_144414_add_table_user_tmp cannot be reverted.\n";

        return false;
    }
    */
}
