<?php

use yii\db\Migration;

/**
 * Handles the creation of table `credit_card`.
 */
class m190212_110302_create_credit_card_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('credit_card', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer()->notNull(),
            'name'=>$this->string(70)->null(),
            'number'=>$this->string(20)->notNull(),
            'date_expire'=>$this->date()->notNull(),
        ]);
        // creates index for column `user_id`
        $this->createIndex(
            'idx-credit_card-user_id',
            'credit_card',
            'user_id'
        );

        $this->addForeignKey(
            'fk-credit_card-user_id',
            'credit_card',
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
            'fk-credit_card-user_id',
            'credit_card'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-credit_card-user_id',
            'credit_card'
        );
        $this->dropTable('credit_card');
    }
}
