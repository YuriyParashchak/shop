<?php

use yii\db\Migration;

/**
 * Class m190203_163203_alter_column_password_user_tmp
 */
class m190203_163203_alter_column_password_user_tmp extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('user_tmp', 'password', $this->string(90)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('user_tmp', 'password', $this->string(50)->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190203_163203_alter_column_password_user_tmp cannot be reverted.\n";

        return false;
    }
    */
}
