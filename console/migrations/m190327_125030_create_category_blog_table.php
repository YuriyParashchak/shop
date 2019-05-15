<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category_blog}}`.
 */
class m190327_125030_create_category_blog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%category_blog}}', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(50)->notNull(),
            'slug'  => $this->string(70)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category_blog}}');
    }
}
