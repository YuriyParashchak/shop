<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%support_request}}`.
 */
class m190227_143430_create_support_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%support_request}}', [
            'id' => $this->primaryKey(),
            'subject_id' => $this->integer()->notNull(),
            'name' => $this->string(70)->null(),
            'email'=>$this->string(70)->null(),
            'body' =>$this->text()->notNull()

        ]);

        $this->createIndex(
            'idx-support_request-contact_subject_id',
            'support_request',
            'subject_id'
        );

        $this->addForeignKey(
            'fk-support_request-contact_subject_id',
            'support_request',
            'subject_id',
            'contact_subject',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-support_request-contact_subject_id',
            'support_request'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-support_request-contact_subject_id',
            'support_request'
        );
        $this->dropTable('{{%support_request}}');
    }
}
