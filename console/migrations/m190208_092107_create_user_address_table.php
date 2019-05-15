<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_address`.
 */
class m190208_092107_create_user_address_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user_address', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer()->notNull(),
            'country'=>$this->string(50)->null(),
            'region'=>$this->string(70)->null(),
            'city'=>$this->string(50)->null(),
            'street'=>$this->string(70)->null(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user_address-user_id',
            'user_address',
            'user_id'
        );

        $this->addForeignKey(
            'fk-user_address-user_id',
            'user_address',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
       // $this->addColumn();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-user_address-user_id',
            'user_address'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-user_address-user_id',
            'user_address'
        );

        $this->dropTable('user_address');
    }
}
