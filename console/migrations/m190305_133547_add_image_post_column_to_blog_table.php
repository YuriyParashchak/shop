<?php

use yii\db\Migration;

/**
 * Handles adding image_post to table `{{%blog}}`.
 */
class m190305_133547_add_image_post_column_to_blog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%blog}}', 'image_post', $this->string()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%blog}}', 'image_post');
    }
}
