<?php

use yii\db\Migration;

/**
 * Handles adding status to table `{{%credit_card}}`.
 */
class m190213_113248_add_status_column_to_credit_card_table extends Migration
{
    const STATUS_ACTIVE = 1;
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(
            'credit_card',
            'status',
            $this->smallInteger()->notNull()->defaultValue(self::STATUS_ACTIVE)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('credit_card','status');
    }
}
