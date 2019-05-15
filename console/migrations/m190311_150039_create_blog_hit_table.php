<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%blog_hit}}`.
 */
class m190311_150039_create_blog_hit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%blog_hit}}', [
            'id' => $this->primaryKey(),
            'event_type' => $this->smallInteger()->notNull()->comment('1-view, 2-like'),
            'blog_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->null(),
            'ip_address' => $this->string(30)->notNull(),
            'click_date' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex('IDX_blog_hit_blogs', 'blog_hit', 'blog_id');
        $this->addForeignKey('FK_blog_hit_blog',
            'blog_hit',
            'blog_id',
            'blog',
            'id');
        $this->createIndex('IDX_blog_hit_user', 'blog_hit', 'user_id');
        $this->addForeignKey('FK_blog_hit_user',
            'blog_hit',
            'user_id',
            'user',
            'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey('FK_blog_hit_blogss', 'blog_hit');
        $this->dropIndex('IDX_blog_hit_blogs', 'blog_hit');
        $this->dropForeignKey('FK_blog_hit_user', 'blog_hit');
        $this->dropIndex('IDX_blog_hit_user', 'blog_hit');
        $this->dropTable('{{%blog_hit}}');
    }
}
