<?php

use yii\db\Migration;

/**
 * Handles adding category_id to table `{{%blog}}`.
 */
class m190327_125910_add_category_id_column_to_blog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%blog}}', 'category_id', $this->integer()->null());

        // creates index for column `category_id`
        $this->createIndex(
            'idx-blog-category_id',
            'blog',
            'category_id'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk-blog-category_id',
            'blog',
            'category_id',
            'category_blog',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-blog-category_id',
            'blog'
        );

        // drops index for column `category_id`
        $this->dropIndex(
            'idx-blog-category_id',
            'blog'
        );
        $this->dropColumn('{{%blog}}', 'category_id');

    }
}
