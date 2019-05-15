<?php

use yii\db\Migration;

/**
 * Class m190225_123428_add_table_value
 */
class m190225_123428_add_table_value extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('attribute_data', [
            'id' => $this->primaryKey(),
            'v_string' => $this->string(255)->null(),
            'v_number' => $this->float([10, 4])->null(),
            'v_boolean' => $this->boolean()->null(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createTable('attribute_values', [
            'id' => $this->primaryKey(),
            'attribute_data_id' => $this->integer()->notNull(),
            'attribute_id' => $this->integer()->notNull(),
        ]);
        $this->createIndex('IDX_ATTRIBUTE_DATA', 'attribute_values', 'attribute_data_id');
        $this->createIndex('IDX_ATTRIBUTE', 'attribute_values', 'attribute_id');
        $this->addForeignKey(
            'FK_ATTRIBUTE_DATA',
            'attribute_values',
            'attribute_data_id',
            'attribute_data',
            'id'
        );
        $this->addForeignKey('FK_ATTRIBUTE',
            'attribute_values',
            'attribute_id',
            'attribute',
            'id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_ATTRIBUTE', 'attribute_values');
        $this->dropForeignKey('FK_ATTRIBUTE_DATA', 'attribute_values');
        $this->dropIndex('IDX_ATTRIBUTE_DATA', 'attribute_values');
        $this->dropIndex('IDX_ATTRIBUTE', 'attribute_values');
        $this->dropTable('attribute_values');
        $this->dropTable('attribute_data');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190225_123428_add_table_value cannot be reverted.\n";

        return false;
    }
    */
}
