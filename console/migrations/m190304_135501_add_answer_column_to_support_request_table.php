<?php

use yii\db\Migration;

/**
 * Handles adding answer to table `{{%support_request}}`.
 */
class m190304_135501_add_answer_column_to_support_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%support_request}}', 'answer', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%support_request}}', 'answer');
    }
}
