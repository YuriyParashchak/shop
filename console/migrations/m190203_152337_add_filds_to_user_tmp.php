<?php

use yii\db\Migration;

/**
 * Class m190203_152337_add_filds_to_user_tmp
 */
class m190203_152337_add_filds_to_user_tmp extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user_tmp',
            'first_name',
            $this->string(70)->null());

        $this->addColumn('user_tmp',
            'last_name',
            $this->string(70)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user_tmp','first_name');
        $this->dropColumn('user_tmp','last_name');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190203_152337_add_filds_to_user_tmp cannot be reverted.\n";

        return false;
    }
    */
}
