<?php

use yii\db\Migration;

/**
 * Class m190204_121831_change_username
 */
class m190204_121831_change_username extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('user', 'username', $this->string(70)->null());
        $this->alterColumn('user_tmp', 'username', $this->string(70)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('user', 'username', $this->string(70)->notNull());
        $this->alterColumn('user_tmp', 'username', $this->string(70)->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190204_121831_change_username cannot be reverted.\n";

        return false;
    }
    */
}
