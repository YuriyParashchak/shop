<?php

use yii\db\Migration;

/**
 * Class m190214_103616_change_username_to_url_name_user_table
 */
class m190214_103616_change_username_to_url_name_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('user', 'username', 'url_name');
        $this->alterColumn('user', 'url_name', $this->string(100)->null()->unique());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('user', 'url_name', 'username');
        $this->alterColumn('user', 'username', $this->string(100)->null());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190214_103616_change_username_to_url_name_user_table cannot be reverted.\n";

        return false;
    }
    */
}
