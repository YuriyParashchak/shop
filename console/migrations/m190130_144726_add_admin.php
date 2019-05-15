<?php

use yii\db\Migration;

/**
 * Class m190130_144726_add_admin
 */
class m190130_144726_add_admin extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('user', ['username' => 'Admin',
            'password_hash' => Yii::$app->security->generatePasswordHash('111111'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'email' => 'siteAdmin@email.com',
            'created_at' => (new \DateTime())->getTimestamp(),
            'updated_at' => (new \DateTime())->getTimestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190130_144726_add_admin cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190130_144726_add_admin cannot be reverted.\n";

        return false;
    }
    */
}
