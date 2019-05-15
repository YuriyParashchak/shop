<?php

use yii\db\Migration;

/**
 * Class m190208_105235_create_user_data_colum
 */
class m190208_105235_create_user_data_colum extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user_profile','birthday',$this->timestamp()->null());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user_profile','birthday');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190208_105235_create_user_data_colum cannot be reverted.\n";

        return false;
    }
    */
}
