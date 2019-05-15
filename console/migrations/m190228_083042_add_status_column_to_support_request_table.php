<?php

use yii\db\Migration;

/**
 * Handles adding status to table `{{%support_request}}`.
 */
class m190228_083042_add_status_column_to_support_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%support_request}}', 'status', $this->smallInteger(6)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%support_request}}', 'status');
    }
}
