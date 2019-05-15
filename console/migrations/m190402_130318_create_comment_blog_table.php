<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment_blog}}`.
 */
class m190402_130318_create_comment_blog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%comment_blog}}', [
            'id' => $this->primaryKey(),
            'text'=>$this->string(),
            'user_id'=>$this->integer(),
            'article_id'=>$this->integer(),
            'status'=>$this->integer(),
            'date'=>$this->date(),
        ]);
        // creates index for column `user_id`
        $this->createIndex(
            'idx-post-user_id',
            'comment_blog',
            'user_id'
        );
        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-post-user_id',
            'comment_blog',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
        // creates index for column `article_id`
        $this->createIndex(
            'idx-article_id',
            'comment_blog',
            'article_id'
        );
        // add foreign key for table `article`
        $this->addForeignKey(
            'fk-article_id',
            'comment_blog',
            'article_id',
            'blog',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%comment_blog}}');
    }
}
