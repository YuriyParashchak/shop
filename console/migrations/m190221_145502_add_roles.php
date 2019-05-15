<?php

use yii\db\Migration;

/**
 * Class m190221_145502_add_roles
 */
class m190221_145502_add_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('user', ['url_name' => 'SuperAdmin',
            'password_hash' => Yii::$app->security->generatePasswordHash('111111'),
            'auth_key' => Yii::$app->security->generateRandomString(),
            'email' => 'superAdmin@email.com',
            'created_at' => (new \DateTime())->getTimestamp(),
            'updated_at' => (new \DateTime())->getTimestamp(),
        ]);
        $superAdmin = \common\models\User::findByEmail('superAdmin@email.com');

        $this->insert('user_profile', [
            'user_id' => $superAdmin->id,
            'first_name' => 'superAdmin',
            'last_name' => 'superAdmin'
        ]);
        $admin = \common\models\User::findByEmail('siteAdmin@email.com');
        $this->insert('user_profile', [
            'user_id' => $admin->id,
            'first_name' => 'Admin',
            'last_name' => 'Admin'
        ]);

        $this->insert('auth_item', [
            'name' => 'admin',
            'type' => 1,
            'created_at' => (new \DateTime())->getTimestamp(),
            'updated_at' => (new \DateTime())->getTimestamp(),
        ]);

        $this->insert('auth_item', [
            'name' => 'superAdmin',
            'type' => 1,
            'created_at' => (new \DateTime())->getTimestamp(),
            'updated_at' => (new \DateTime())->getTimestamp(),
        ]);

        $this->insert('auth_item', [
            'name' => 'user',
            'type' => 1,
            'created_at' => (new \DateTime())->getTimestamp(),
            'updated_at' => (new \DateTime())->getTimestamp(),
        ]);

        $this->insert('auth_item_child', [
            'parent' => 'superAdmin',
            'child' => 'admin',
        ]);

        $this->insert('auth_item_child', [
            'parent' => 'admin',
            'child' => 'user',
        ]);

        $this->insert('auth_assignment', [
            'item_name' => 'superAdmin',
            'user_id' => $superAdmin->id,
            'created_at' => (new \DateTime())->getTimestamp(),
        ]);

        $this->insert('auth_assignment', [
            'item_name' => 'admin',
            'user_id' => $admin->id,
            'created_at' => (new \DateTime())->getTimestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190221_145502_add_roles cannot be reverted.\n";

        return false;
    }
    */
}
