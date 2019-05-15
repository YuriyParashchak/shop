<?php

use yii\db\Migration;

/**
 * Handles adding date_message to table `{{%support_request}}`.
 */
class m190304_103927_add_date_message_column_to_support_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%support_request}}', 'date_message', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%support_request}}', 'date_message');
    }
}
